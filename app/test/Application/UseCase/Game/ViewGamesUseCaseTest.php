<?php

declare(strict_types=1);

namespace Test\Application\UseCase\Game;

use App\Application\UseCase\Game\ViewGamesUseCase;
use App\Domain\Game\Game;
use App\Domain\Game\GameRepository;
use App\Infrastructure\Factory\CompanyFactory;
use App\Infrastructure\Factory\SystemFactory;
use Exception;
use PHPUnit\Framework\TestCase;

class ViewGamesUseCaseTest extends TestCase
{
    /**
     * @group happypath
     * @throws Exception */
    public function testHappyPath()
    {
        $expected = [
            new Game(
                1,
                "Alex Kidd in Miracle world",
                "Plataformas",
                "1986-11-01",
                CompanyFactory::buildFromArray([
                    'company_id' => 1,
                    'company_name' => 'SEGA',
                    'founded_on' => '1960-06-03',
                    'location' => 'Shinagawa, Japón'
                ]),
                SystemFactory::buildFromArrayAndCompany([
                    'system_id' => 1,
                    'system_name' => 'Master System',
                    'description' => 'Comercializada en Japón bajo el nombre SEGA Mark III, es una consola de videojuegos de 8 bits basada en cartuchos y tarjetas, que fue desarrollada por SEGA. Aunque estuvo muy por detrás en ventas fuera de Europa, Brasil y con un éxito moderado en Argentina, la experiencia sentó los cimientos para que SEGA continuara con su liderazgo en esos mercados durante la siguiente generación con la Mega Drive. Su cese de producción, con excepción de Brasil, fue en 1996.',
                    'generation' => "3",
                    'system_released_on' => "1985-10-20"
                ],
                    CompanyFactory::buildFromArray([
                        'company_id' => 1,
                        'company_name' => 'SEGA',
                        'founded_on' => '1960-06-03',
                        'location' => 'Shinagawa, Japón'
                    ])
                )
            ),
            new Game(
                2,
                "Phantasy Star",
                "JRPG",
                "1987-12-20",
                CompanyFactory::buildFromArray([
                    'company_id' => 1,
                    'company_name' => 'SEGA',
                    'founded_on' => '1960-06-03',
                    'location' => 'Shinagawa, Japón'
                ]),             SystemFactory::buildFromArrayAndCompany([
                'system_id' => 1,
                'system_name' => 'Master System',
                'description' => 'Comercializada en Japón bajo el nombre SEGA Mark III, es una consola de videojuegos de 8 bits basada en cartuchos y tarjetas, que fue desarrollada por SEGA. Aunque estuvo muy por detrás en ventas fuera de Europa, Brasil y con un éxito moderado en Argentina, la experiencia sentó los cimientos para que SEGA continuara con su liderazgo en esos mercados durante la siguiente generación con la Mega Drive. Su cese de producción, con excepción de Brasil, fue en 1996.',
                'generation' => "3",
                'system_released_on' => "1985-10-20"
            ],
                CompanyFactory::buildFromArray([
                    'company_id' => 1,
                    'company_name' => 'SEGA',
                    'founded_on' => '1960-06-03',
                    'location' => 'Shinagawa, Japón'
                ])
            )
            ),
            new Game(
                3,
                "Sonic 2",
                "Plataformas",
                "1992-11-01",
                CompanyFactory::buildFromArray([
                    'company_id' => 7,
                    'company_name' => 'Aspect',
                    'founded_on' => '1991-03-25',
                    'location' => 'Tokio, Japón'
                ]),
                SystemFactory::buildFromArrayAndCompany([
                    'system_id' => 1,
                    'system_name' => 'Master System',
                    'description' => 'Comercializada en Japón bajo el nombre SEGA Mark III, es una consola de videojuegos de 8 bits basada en cartuchos y tarjetas, que fue desarrollada por SEGA. Aunque estuvo muy por detrás en ventas fuera de Europa, Brasil y con un éxito moderado en Argentina, la experiencia sentó los cimientos para que SEGA continuara con su liderazgo en esos mercados durante la siguiente generación con la Mega Drive. Su cese de producción, con excepción de Brasil, fue en 1996.',
                    'generation' => "3",
                    'system_released_on' => "1985-10-20",
                ],
                    CompanyFactory::buildFromArray([
                        'company_id' => 7,
                        'company_name' => 'Aspect',
                        'founded_on' => '1991-03-25',
                        'location' => 'Tokio, Japón'
                    ])
                )
            )];

        $sut = new ViewGamesUseCase($this->getMock());

        $actual = $sut->execute(1, 0);

        self::assertEquals($expected, $actual);
    }

    /** @throws Exception */
    private function getMock()
    {
        $expected = [
            new Game(
                1,
                "Alex Kidd in Miracle world",
                "Plataformas",
                "1986-11-01",
                CompanyFactory::buildFromArray([
                    'company_id' => 1,
                    'company_name' => 'SEGA',
                    'founded_on' => '1960-06-03',
                    'location' => 'Shinagawa, Japón'
                ]),
                SystemFactory::buildFromArrayAndCompany([
                    'system_id' => 1,
                    'system_name' => 'Master System',
                    'description' => 'Comercializada en Japón bajo el nombre SEGA Mark III, es una consola de videojuegos de 8 bits basada en cartuchos y tarjetas, que fue desarrollada por SEGA. Aunque estuvo muy por detrás en ventas fuera de Europa, Brasil y con un éxito moderado en Argentina, la experiencia sentó los cimientos para que SEGA continuara con su liderazgo en esos mercados durante la siguiente generación con la Mega Drive. Su cese de producción, con excepción de Brasil, fue en 1996.',
                    'generation' => "3",
                    'system_released_on' => "1985-10-20"
                ],
                    CompanyFactory::buildFromArray([
                        'company_id' => 1,
                        'company_name' => 'SEGA',
                        'founded_on' => '1960-06-03',
                        'location' => 'Shinagawa, Japón'
                    ])
                )
            ),
            new Game(
                2,
                "Phantasy Star",
                "JRPG",
                "1987-12-20",
                CompanyFactory::buildFromArray([
                    'company_id' => 1,
                    'company_name' => 'SEGA',
                    'founded_on' => '1960-06-03',
                    'location' => 'Shinagawa, Japón'
                ]),             SystemFactory::buildFromArrayAndCompany([
                'system_id' => 1,
                'system_name' => 'Master System',
                'description' => 'Comercializada en Japón bajo el nombre SEGA Mark III, es una consola de videojuegos de 8 bits basada en cartuchos y tarjetas, que fue desarrollada por SEGA. Aunque estuvo muy por detrás en ventas fuera de Europa, Brasil y con un éxito moderado en Argentina, la experiencia sentó los cimientos para que SEGA continuara con su liderazgo en esos mercados durante la siguiente generación con la Mega Drive. Su cese de producción, con excepción de Brasil, fue en 1996.',
                'generation' => "3",
                'system_released_on' => "1985-10-20"
            ],
                CompanyFactory::buildFromArray([
                    'company_id' => 1,
                    'company_name' => 'SEGA',
                    'founded_on' => '1960-06-03',
                    'location' => 'Shinagawa, Japón'
                ])
            )
            ),
            new Game(
                3,
                "Sonic 2",
                "Plataformas",
                "1992-11-01",
                CompanyFactory::buildFromArray([
                    'company_id' => 7,
                    'company_name' => 'Aspect',
                    'founded_on' => '1991-03-25',
                    'location' => 'Tokio, Japón'
                ]),
                SystemFactory::buildFromArrayAndCompany([
                    'system_id' => 1,
                    'system_name' => 'Master System',
                    'description' => 'Comercializada en Japón bajo el nombre SEGA Mark III, es una consola de videojuegos de 8 bits basada en cartuchos y tarjetas, que fue desarrollada por SEGA. Aunque estuvo muy por detrás en ventas fuera de Europa, Brasil y con un éxito moderado en Argentina, la experiencia sentó los cimientos para que SEGA continuara con su liderazgo en esos mercados durante la siguiente generación con la Mega Drive. Su cese de producción, con excepción de Brasil, fue en 1996.',
                    'generation' => "3",
                    'system_released_on' => "1985-10-20",
                ],
                    CompanyFactory::buildFromArray([
                        'company_id' => 7,
                        'company_name' => 'Aspect',
                        'founded_on' => '1991-03-25',
                        'location' => 'Tokio, Japón'
                    ])
                )
            )];

        $mock = $this->createMock(GameRepository::class);
        $mock->expects(self::once())->method('getGames')->willReturn($expected);

        return $mock;
    }
}
