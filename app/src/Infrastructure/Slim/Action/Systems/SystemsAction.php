<?php
declare(strict_types=1);

namespace App\Infrastructure\Slim\Action\Systems;

use App\Infrastructure\Slim\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;

class SystemsAction extends Action
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $id_sys = $this->getId();

        $page = $this->getPage();
        $ini = $this->getOffset($page);

        $sqlTotal = "SELECT COUNT(*) as `total` FROM games WHERE system_id = $id_sys";
        $sqlResult = "SELECT * FROM games WHERE system_id = $id_sys LIMIT :limit OFFSET :ini";

        return $this->viewGamesResults($sqlResult, $ini, $sqlTotal, $page);
    }
}

