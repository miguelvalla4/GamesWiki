<?php

declare(strict_types=1);

namespace App\Infrastructure\Slim\Action\Companies;

use DateTime;
use PDO;
use App\Infrastructure\Slim\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class CompaniesAction extends Action
{
    private $pdo;

    public function __construct(LoggerInterface $logger)
    {
        parent::__construct($logger);

        $this->pdo = new PDO(
            'mysql:host=db;dbname=good_old_videogames;charset=utf8mb4',
            $_ENV['DATABASE_USER'],
            $_ENV['DATABASE_PASSWORD']
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        //Almacenamiento en variable del id de la compañia
        $id_company = $this->request->getAttribute('id');

        //Variables para la paginacion
        $page = (int) ($this->request->getQueryParams()['page'] ?? 1);
        $limite =  3;
        $ini = $page > 1 ? $limite * $page - $limite : 0;

        //Consultas
        $sqlTotal = "SELECT COUNT(*) as `total` FROM games WHERE company_id = $id_company";
        $sqlResult = "SELECT * FROM games WHERE company_id = $id_company LIMIT :limite OFFSET :ini";

        //Ejecucion de las consultas
        try {
            $result = $this->getResults($this->pdo, $sqlResult, $limite, $ini);
            $total = $this->getResults($this->pdo, $sqlTotal, $limite, $ini);

            $cntReg = $total[0]['total'];

            $nPags = ceil($cntReg / $limite);
        } catch (PDOException $e) {
            die('Error.');
        }

        $result = $this->getTags($result);

        //return
        if ($page > $nPags) {
            return $this->respondWithData([
                'message' => 'No me quedan mas datos que mostrarte :\'(',
                'FILE' => __FILE__
            ]);
        }

        return $this->respondWithData([
            'message' => $result,
            'FILE' => __FILE__
        ]);
    }

    private function getTags(array $result): array
    {
        $sqlNipon = "SELECT id FROM companies WHERE companies.location  LIKE '%, Japón'";
        $nipon = $this->getResults($this->pdo, $sqlNipon);

        //$date = date('d-m-Y');

        //Variable que guarda la fecha de referencia para tag VINTAGE
        $vintage = new DateTime('-20 year');
        //$vintage = strtotime('-20 year', strtotime($date));
        //$vintage = date('Y-m-d', $vintage);

        //Variable que guarda la fecha de referencia para tag OLDIE
        $oldie = new DateTime('-30 year');
        //$oldie = strtotime('-30 year', strtotime($date));
        //$oldie = date('Y-m-d', $oldie);

        foreach ($result as $key => $value) {
            foreach ($nipon as $valor) {
                if ($valor['id'] === $result[$key]['company_id']) {
                    $result[$key]['tag'][] = "Nipón";
                }
            }

            if ((($result[$key]['type'] === "Lucha") || ($result[$key]['type'] === "Beat 'em up"))) {
                $result[$key]['tag'][] = "Machacabotones";
            }

            if ($result[$key]['released_on'] >= $oldie && $result[$key]['released_on'] < $vintage) {
                $result[$key]['tag'][] = "Vintage";
            }

            if ($result[$key]['released_on'] < $oldie) {
                $result[$key]['tag'][] = "Oldie but Goldie";
            }
        }
        return $result;
    }

    private function getResults(PDO $pdo, string $sql, ?int $limite = null, ?int $ini = null): array
    {
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':limite', $limite, \PDO::PARAM_INT);
        $stmt->bindValue(':ini', $ini, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?? [];
    }
}
