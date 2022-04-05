<?php

declare(strict_types=1);

namespace Test\Application\UseCase\Game;

use App\Application\UseCase\Game\ViewGamesBySystemIdUseCause;
use App\Domain\Game\GameRepository;
use App\Infrastructure\Persistence\Pdo\MySql\Game\MySqlGameRepository;
use PHPUnit\Framework\TestCase;

class ViewGamesBySystemIdUseCauseTest extends TestCase
{
    /**
     * @group happypath
     */
    public function testHappyPath()
    {
        $expected = [];
        $sut = new ViewGamesBySystemIdUseCause($this->getMock());
        $actual = $sut->execute(1,1,0);

        self::assertEquals($expected, $actual);
    }

    public function getMock()
    {
        $mock = $this->createMock(GameRepository::class);
        $mock->expects(self::once())->method('getGamesBySystemId')->willReturn([]);

        return $mock;
    }
}
