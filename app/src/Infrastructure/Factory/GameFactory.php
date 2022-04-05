<?php

declare(strict_types=1);

namespace App\Infrastructure\Factory;

use App\Domain\Game\Game;
use Exception;

class GameFactory
{
    /** @throws Exception */
    public static function buildFromArray(array $rawGame): Game
    {
        $company = CompanyFactory::buildFromArray([
            'company_id' => $rawGame['company_id'],
            'company_name' => $rawGame['company_name'],
            'founded_on' => $rawGame['founded_on'],
            'location' => $rawGame['location'],
        ]);

        return new Game(
            (int) $rawGame['games_id'],
            $rawGame['title'],
            $rawGame['type'],
            $rawGame['games_released_on'],
            $company,
            SystemFactory::buildFromArrayAndCompany([
                    'system_id' => $rawGame['system_id'],
                    'system_name' => $rawGame['system_name'],
                    'description' => $rawGame['description'],
                    'generation' => $rawGame['generation'],
                    'system_released_on' => $rawGame['system_released_on'],
                ],
                $company
            )
        );
    }
}
