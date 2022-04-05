<?php
declare(strict_types=1);

namespace App\Infrastructure\Slim\Action\Systems;

use App\Application\UseCase\Game\ViewGamesBySystemIdUseCause;
use App\Infrastructure\Slim\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class SystemsAction extends Action
{
    protected $ViewGamesBySystemIdUseCase;

    public function __construct(ViewGamesBySystemIdUseCause $ViewGamesBySystemIdUseCase, LoggerInterface $logger)
    {
        $this->ViewGamesBySystemIdUseCase = $ViewGamesBySystemIdUseCase;
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
            'message' =>  $this->ViewGamesBySystemIdUseCase->execute($id, $page, $ini),
            'ruta' => __FILE__,
        ));
    }
}

