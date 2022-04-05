<?php
declare(strict_types=1);

namespace App\Infrastructure\Slim\Action\Game;

use App\Application\UseCase\Game\ViewGamesUseCase;
use App\Infrastructure\Slim\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class GameAction extends Action
{
    protected $viewGameUseCase;

    public function __construct(ViewGamesUseCase $viewGamesUseCase, LoggerInterface $logger)
    {
        $this->viewGameUseCase = $viewGamesUseCase;
        parent::__construct($logger);
    }

    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $page = $this->getPage();
        $ini = $this->getOffset($page);

        return $this->respondWithData(array(
            'message' =>  $this->viewGameUseCase->execute($page, $ini),
            'ruta' => __FILE__,
        ));
    }
}

