<?php
declare(strict_types=1);

namespace App\Infrastructure\Slim\Action\Companies;

use App\Infrastructure\Slim\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;

class CompaniesAction extends Action
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $id_company = $this->getId();

        $page = $this->getPage();
        $ini = $this->getOffset($page);

        $sqlTotal = "SELECT COUNT(*) as `total` FROM games WHERE company_id = $id_company";
        $sqlResult = "SELECT * FROM games WHERE company_id = $id_company LIMIT :limit OFFSET :ini";

        return $this->viewGamesResults($sqlResult, $ini, $sqlTotal, $page);
    }
}
