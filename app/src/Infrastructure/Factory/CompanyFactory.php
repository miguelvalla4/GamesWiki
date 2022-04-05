<?php
declare(strict_types=1);

namespace App\Infrastructure\Factory;

use App\Domain\Company\Company;
use Exception;

class CompanyFactory
{
    /** @throws Exception */
    public static function buildFromArray(array $rawCompany): Company
    {
        return new Company(
            (int) $rawCompany['company_id'],
            $rawCompany['company_name'],
            $rawCompany['founded_on'],
            $rawCompany['location']
        );
    }
}
