<?php
declare(strict_types=1);

namespace App\Infrastructure\Slim\Action\Companies;

use App\Application\UseCase\Game\ViewGameByCompanyIdUseCase;
use App\Domain\Company\CompanyRepository;
use App\Infrastructure\Slim\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class CompaniesAction extends Action
{
    protected $ViewGameByCompanyIdUseCase;

    public function __construct(ViewGameByCompanyIdUseCase $ViewGameByCompanyIdUseCase, LoggerInterface $logger)
    {
        $this->ViewGameByCompanyIdUseCase = $ViewGameByCompanyIdUseCase;
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
            'message' =>  $this->ViewGameByCompanyIdUseCase->execute($id, $page, $ini),
            'ruta' => __FILE__,
        ));
    }
}
