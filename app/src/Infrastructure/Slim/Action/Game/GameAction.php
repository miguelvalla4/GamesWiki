<?php

declare(strict_types=1);

namespace App\Infrastructure\Slim\Action\Game;

use App\Infrastructure\Slim\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;

class GameAction extends Action
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $page = $this->getPage();
        $ini = $this->getOffset($page);

        $sqlTotal = "SELECT COUNT(*) as `total` FROM games";
        $sqlResult = "SELECT * FROM games LIMIT :limit OFFSET :ini";

        return $this->viewGamesResults($sqlResult, $ini, $sqlTotal, $page);
    }
}

