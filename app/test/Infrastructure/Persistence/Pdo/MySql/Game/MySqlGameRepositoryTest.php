<?php

declare(strict_types=1);

namespace Test\Infrastructure\Persistence\Pdo\MySql\Game;

use App\Domain\Company\Company;
use App\Domain\Game\Game;
use App\Domain\System\System;
use App\Infrastructure\Persistence\Pdo\MySql\Game\MySqlGameRepository;
use Test\Infrastructure\Persistence\Pdo\MySql\MySqlAwareTestCase;

class MySqlGameRepositoryTest extends MySqlAwareTestCase
{
    public function testGetGames()
    {
        $sut = new MySqlGameRepository($this->getConnection());

        $result = $sut->getGames(0, 1);

        self::assertCount(3, $result);

        foreach ($result as $game) {
            self::assertInstanceOf(Game::class, $game);
            self::assertInstanceOf(Company::class, $game->getCompany());
            self::assertInstanceOf(System::class, $game->getSystem());
        }
    }

    public function testGetGamesByCompanyId()
    {

    }
}
