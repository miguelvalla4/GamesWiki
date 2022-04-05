<?php
declare(strict_types=1);

namespace App\Infrastructure\Slim\Action;

use App\Domain\DomainException\DomainRecordNotFoundException;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Log\LoggerInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use PDO;
use DateTime;
use PDOException;

abstract class Action
{
    protected const LIMIT = 3;

    protected $pdo;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Response
     */
    protected $response;

    /**
     * @var array
     */
    protected $args;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;

        $this->pdo = new PDO(
            'mysql:host=db;dbname=good_old_videogames;charset=utf8mb4',
            $_ENV['DATABASE_USER'],
            $_ENV['DATABASE_PASSWORD']
        );
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     * @throws HttpNotFoundException
     * @throws HttpBadRequestException
     */
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;

        try {
            return $this->action();
        } catch (DomainRecordNotFoundException $e) {
            throw new HttpNotFoundException($this->request, $e->getMessage());
        }
    }

    /**
     * @return Response
     * @throws DomainRecordNotFoundException
     * @throws HttpBadRequestException
     */
    abstract protected function action(): Response;

    /**
     * @return array|object
     * @throws HttpBadRequestException
     */
    protected function getFormData()
    {
        $input = json_decode(file_get_contents('php://input'));

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new HttpBadRequestException($this->request, 'Malformed JSON input.');
        }

        return $input;
    }

    /**
     * @param string $name
     * @return mixed
     * @throws HttpBadRequestException
     */
    protected function resolveArg(string $name)
    {
        if (!isset($this->args[$name])) {
            throw new HttpBadRequestException($this->request, "Could not resolve argument `$name`.");
        }

        return $this->args[$name];
    }

    /**
     * @param array|object|null $data
     * @param int $statusCode
     * @return Response
     */
    protected function respondWithData($data = null, int $statusCode = 200): Response
    {
        $payload = new ActionPayload($statusCode, $data);

        return $this->respond($payload);
    }

    /**
     * @param ActionPayload $payload
     * @return Response
     */
    protected function respond(ActionPayload $payload): Response
    {
        $json = json_encode($payload, JSON_PRETTY_PRINT);

        $this->response->getBody()->write($json);

        return $this->response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($payload->getStatusCode());
    }

    protected function getId(): int
    {
        return (int) $this->request->getAttribute('id');
    }

    protected function getPage(): int
    {
        return (int)($this->request->getQueryParams()['page'] ?? 1);
    }

    protected function getOffset(int $page): int
    {
        return $page > 1 ? self::LIMIT * $page - self::LIMIT : 0;
    }

    /**
     * @throws Exception
     */
    protected function getTags(array $gamesResults): array
    {
        $queryJapan = "SELECT id FROM companies WHERE companies.location  LIKE '%, Japón'";
        $japanResults = $this->getQueryExecute($this->pdo, $queryJapan);

        return $this->getGamesResults($gamesResults, $japanResults);
    }

    protected function viewGamesResults(string $sqlResult, ?int $ini = null, string $sqlTotal, int $page): Response
    {
        $gamesResults = $this->queryDataResult($sqlResult, $ini);
        $gamesResults = $this->getTags($gamesResults);

        $totalGamesResults = $this->queryNumberDataResult($sqlTotal);

        if ($page > ceil($totalGamesResults[0]['total'] / self::LIMIT)) {
            return $this->respondWithData([
                'message' => 'I dont have any left',
                'FILE' => __FILE__
            ]);
        }

        return $this->respondWithData([
            'message' => $gamesResults,
            'FILE' => __FILE__
        ]);
    }

    /**
     * @throws Exception
     */
    protected function getGamesResults(array $gamesResults, array $japanResults): array
    {
        foreach ($gamesResults as $key => $value) {
            foreach ($japanResults as $valor) {
                if ($valor['id'] === $gamesResults[$key]['company_id']) {
                    $gamesResults[$key]['tag'][] = "Nipon";
                }
            }
            $gamesResults = $this->getTypeGameTag($gamesResults, $key);
            try {
                $gamesResults = $this->getAgeGameType($gamesResults, $key);
            } catch (Exception $e) {
            }
        }
        return $gamesResults;
    }

    protected function getTypeGameTag(array $gamesResults,  $key): array
    {
        if (($gamesResults[$key]['type'] === "Lucha") || ($gamesResults[$key]['type'] === "Beat 'em up")) {
            $gamesResults[$key]['tag'][] = "Machacabotones";
        }
        return $gamesResults;
    }

    /**
     * @param array $gamesResults
     * @param int $key
     * @return array
     * @throws Exception
     */
    protected function getAgeGameType(array $gamesResults, int $key): array
    {
        $dateToCompare = $this->getDateToCompare($gamesResults[$key]['released_on']);

        if ($dateToCompare <= new DateTime('-20 year') &&  $dateToCompare > new DateTime('-30 year')) {
            $gamesResults[$key]['tag'][] = "Vintage";
        }else if($dateToCompare <= new DateTime('-30 year')){
            $gamesResults[$key]['tag'][] = "Oldie but Goldie";
        }
        return $gamesResults;
    }

    /**
     * @param string $released_on
     * @return DateTime
     */
    protected function getDateToCompare(string $released_on): DateTime
    {
        try {
            $dateToCompare = new DateTime($released_on);
        } catch (Exception $e) {
        }
        return $dateToCompare;
    }
}
