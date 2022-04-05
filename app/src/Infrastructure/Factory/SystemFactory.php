<?php
declare(strict_types=1);

namespace App\Infrastructure\Factory;

use App\Domain\Company\Company;
use App\Domain\System\System;
use Exception;

class SystemFactory
{
    /** @throws Exception */
    public static function buildFromArrayAndCompany(array $rawSystem, Company $company): System
    {
        return new System(
            (int) $rawSystem['system_id'],
            $rawSystem['system_name'],
            $rawSystem['description'],
            $rawSystem['generation'],
            $rawSystem['system_released_on'],
            $company
        );
    }
}
