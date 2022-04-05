<?php

declare(strict_types=1);

namespace Test\Application\UseCase\Game;

use App\Application\UseCase\Game\ViewGameByCompanyIdUseCase;
use App\Domain\Game\GameRepository;
use PHPUnit\Framework\TestCase;

class ViewGamesByCompanyIdUseCaseTest extends TestCase
{
    /**
     * @group happypath
     */
    public function testHappyPath()
    {
        $expected = [];
        $sut = new ViewGameByCompanyIdUseCase($this->getMock());
        $actual = $sut->execute(1,1,0);

        self::assertEquals($expected, $actual);
    }

    public function getMock()
    {
        $mock = $this->createMock(GameRepository::class);
        $mock->expects(self::once())->method('getGamesByCompanyId')->willReturn([]);

        return $mock;
    }
}
