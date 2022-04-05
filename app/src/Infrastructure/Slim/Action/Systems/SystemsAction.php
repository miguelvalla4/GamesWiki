<?php
declare(strict_types=1);

namespace App\Infrastructure\Slim\Action\Systems;

use App\Domain\Game\GameRepository;
use App\Infrastructure\Slim\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class SystemsAction extends Action
{
    protected $gameRepository;

    public function __construct(GameRepository $gameRepository, LoggerInterface $logger)
    {
        $this->gameRepository = $gameRepository;
        parent::__construct($logger);
    }

    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $page = $this->getPage();
        $ini = $this->getOffset($page);
        $id = $this->getId();

        return $this->respondWithData(array(
            'message' =>  $this->gameRepository->getGamesBySystemId($id, $page, $ini),
            'ruta' => __FILE__,
        ));
    }
}

