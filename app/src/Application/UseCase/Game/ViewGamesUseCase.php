<?php

declare(strict_types=1);

namespace App\Application\UseCase\Game;

use App\Domain\Game\GameRepository;

class ViewGamesUseCase
{
    protected $gameRepository;

    public function __construct(GameRepository $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    public function execute(int $page, int $ini): array
    {
        return $this->gameRepository->getGames($page, $ini);
    }
}
