<?php

declare(strict_types=1);

namespace Test\Application\UseCase\Game;

use App\Application\UseCase\Game\ViewGamesUseCase;
use App\Domain\Game\GameRepository;
use PHPUnit\Framework\TestCase;

class ViewGamesUseCaseTest extends TestCase
{
    /**
     * @group happypath
     */
    public function testHappyPath()
    {
        $expected = [];

        $sut = new ViewGamesUseCase($this->getMock());

        $actual = $sut->execute(1, 0);

        self::assertEquals($expected, $actual);
    }

    private function getMock()
    {
        $mock = $this->createMock(GameRepository::class);
        $mock->expects(self::once())->method('getGames')->willReturn([]);

        return $mock;
    }
}
