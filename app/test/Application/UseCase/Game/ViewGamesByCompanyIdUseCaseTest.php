<?php

declare(strict_types=1);

namespace Test\Application\UseCase\Game;

use App\Application\UseCase\Game\ViewGameByCompanyIdUseCase;
use App\Domain\Game\Game;
use App\Domain\Game\GameRepository;
use App\Infrastructure\Factory\CompanyFactory;
use App\Infrastructure\Factory\SystemFactory;
use Exception;
use PHPUnit\Framework\TestCase;

class ViewGamesByCompanyIdUseCaseTest extends TestCase
{
    /**
     * @group happypath
     * @throws Exception
     */
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
                4,
                "Columns",
                "Puzzle",
                "1990-10-06",
                CompanyFactory::buildFromArray([
                    'company_id' => 1,
                    'company_name' => 'SEGA',
                    'founded_on' => '1960-06-03',
                    'location' => 'Shinagawa, Japón'
                ]),
                SystemFactory::buildFromArrayAndCompany([
                    'system_id' => 2,
                    'system_name' => 'Game Gear',
                    'description' => 'Es una videoconsola portátil creada por Sega en respuesta a la Game Boy de Nintendo. Es la tercera consola portátil con pantalla en color de la historia, después de la Atari Lynx y la Turbo Express. El proyecto comenzó en 1989 bajo el nombre de "Project Mercury" y fue lanzada en Japón el 6 de octubre de 1990. En América y Europa fue lanzada en 1991 y en Australia en 1992. El soporte para este sistema se abandonó a principios de 1997.',
                    'generation' => "4",
                    'system_released_on' => "1990-10-06",
                ],
                    CompanyFactory::buildFromArray([
                        'company_id' => 1,
                        'company_name' => 'SEGA',
                        'founded_on' => '1960-06-03',
                        'location' => 'Shinagawa, Japón'
                    ])
                )
            )];

        $sut = new ViewGameByCompanyIdUseCase($this->getMock());
        $actual = $sut->execute(1,1,0);

        self::assertEquals($expected, $actual);
    }

    /** @throws Exception */
    public function getMock()
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
                4,
                "Columns",
                "Puzzle",
                "1990-10-06",
                CompanyFactory::buildFromArray([
                    'company_id' => 1,
                    'company_name' => 'SEGA',
                    'founded_on' => '1960-06-03',
                    'location' => 'Shinagawa, Japón'
                ]),
                SystemFactory::buildFromArrayAndCompany([
                    'system_id' => 2,
                    'system_name' => 'Game Gear',
                    'description' => 'Es una videoconsola portátil creada por Sega en respuesta a la Game Boy de Nintendo. Es la tercera consola portátil con pantalla en color de la historia, después de la Atari Lynx y la Turbo Express. El proyecto comenzó en 1989 bajo el nombre de "Project Mercury" y fue lanzada en Japón el 6 de octubre de 1990. En América y Europa fue lanzada en 1991 y en Australia en 1992. El soporte para este sistema se abandonó a principios de 1997.',
                    'generation' => "4",
                    'system_released_on' => "1990-10-06",
                ],
                    CompanyFactory::buildFromArray([
                        'company_id' => 1,
                        'company_name' => 'SEGA',
                        'founded_on' => '1960-06-03',
                        'location' => 'Shinagawa, Japón'
                    ])
                )
            )];

        $mock = $this->createMock(GameRepository::class);
        $mock->expects(self::once())->method('getGamesByCompanyId')->willReturn($expected);

        return $mock;
    }
}
