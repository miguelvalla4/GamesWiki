<?php

declare(strict_types=1);

namespace App\Application\UseCase\Game;

use App\Domain\Game\GameRepository;

class ViewGameByCompanyIdUseCase
{
    protected $repository;

    public function __construct(GameRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(int $id, int $page, int $ini): array
    {
        return $this->repository->getGamesByCompanyId($id, $page, $ini);
    }
}
