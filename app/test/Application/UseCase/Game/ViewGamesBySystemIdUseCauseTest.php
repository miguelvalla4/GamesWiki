<?php

declare(strict_types=1);

namespace Test\Application\UseCase\Game;

use App\Application\UseCase\Game\ViewGamesBySystemIdUseCause;
use App\Domain\Game\Game;
use App\Domain\Game\GameRepository;
use App\Infrastructure\Factory\CompanyFactory;
use App\Infrastructure\Factory\SystemFactory;
use DomainException;
use Exception;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ViewGamesBySystemIdUseCauseTest extends TestCase
{
    /**
     * @group happypath
     * @throws Exception
     */
    public function testHappyPath()
    {
        // No tienen por qué coincidir
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

        $sut = new ViewGamesBySystemIdUseCause($this->getMock());
        $actual = $sut->execute(1,1,0);

        self::assertEquals($expected, $actual);
    }

    /**
     * @throws Exception
     */
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
                        'system_released_on' => "1985-10-20",
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
                ]),
                SystemFactory::buildFromArrayAndCompany([
                        'system_id' => 1,
                        'system_name' => 'Master System',
                        'description' => 'Comercializada en Japón bajo el nombre SEGA Mark III, es una consola de videojuegos de 8 bits basada en cartuchos y tarjetas, que fue desarrollada por SEGA. Aunque estuvo muy por detrás en ventas fuera de Europa, Brasil y con un éxito moderado en Argentina, la experiencia sentó los cimientos para que SEGA continuara con su liderazgo en esos mercados durante la siguiente generación con la Mega Drive. Su cese de producción, con excepción de Brasil, fue en 1996.',
                        'generation' => "3",
                        'system_released_on' => "1985-10-20",
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
        $mock->expects(self::once())->method('getGamesBySystemId')->willReturn($expected);

        return $mock;
    }

    /** @throws Exception */
    public function testFailedWhenSystemFoundedAfterNow()
    {
        self::expectException(DomainException::class);

        $sut = new ViewGamesBySystemIdUseCause($this->getMockException());

        $sut->execute(1,1,0);
    }

    /** @throws Exception */
    private function getMockException()
    {
        $mock = $this->createMock(GameRepository::class);

        $mock->expects(self::never())->method('getGamesBySystemId')->willReturn([
            new Game(
                1,
                "Alex Kidd in Miracle world",
                "Plataformas",
                "1986-11-01",
                CompanyFactory::buildFromArray([
                    'company_id' => 1,
                    'company_name' => 'SEGA',
                    'founded_on' => '2060-06-03',
                    'location' => 'Shinagawa, Japón'
                ]),
                SystemFactory::buildFromArrayAndCompany([
                    'system_id' => 1,
                    'system_name' => 'Master System',
                    'description' => 'Comercializada en Japón bajo el nombre SEGA Mark III, es una consola de videojuegos de 8 bits basada en cartuchos y tarjetas, que fue desarrollada por SEGA. Aunque estuvo muy por detrás en ventas fuera de Europa, Brasil y con un éxito moderado en Argentina, la experiencia sentó los cimientos para que SEGA continuara con su liderazgo en esos mercados durante la siguiente generación con la Mega Drive. Su cese de producción, con excepción de Brasil, fue en 1996.',
                    'generation' => "3",
                    'system_released_on' => "1985-10-20",
                ],
                    CompanyFactory::buildFromArray([
                        'company_id' => 1,
                        'company_name' => 'SEGA',
                        'founded_on' => '1960-06-03',
                        'location' => 'Shinagawa, Japón'
                    ])
                )
            )]
        );

        return $mock;
    }
    /**
    * @group unhappypath
    */
    public function testValidLocation()
    {
        self::expectException(InvalidArgumentException::class);

        $sut = new ViewGamesBySystemIdUseCause($this->getMockValidLocation());

        $sut->execute(1,1,0);
    }

    private function getMockValidLocation()
    {
        $mock = $this->createMock(GameRepository::class);

        $mock->expects(self::never())->method('getGamesBySystemId')->willReturn([
            new Game(
                1,
                "Alex Kidd in Miracle world",
                "Plataformas",
                "1986-11-01",
                CompanyFactory::buildFromArray([
                    'company_id' => 1,
                    'company_name' => 'SEGA',
                    'founded_on' => '2060-06-03',
                    'location' => 'Shinagawa. Japón'
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
                        'founded_on' => '2060-06-03',
                        'location' => 'Shinagawa. Japón'
                    ])
                )
            )
        ]);

        return $mock;
    }
}
