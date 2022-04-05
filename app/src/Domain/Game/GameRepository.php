<?php
declare(strict_types=1);

namespace App\Domain\Game;

interface GameRepository
{
    public function getGames(int $page, int $ini): array;

    public function getGamesByCompanyId(int $id, int $page, int $ini): array;

    public function getGamesBySystemId(int $id, int $page, int $ini): array;
}
