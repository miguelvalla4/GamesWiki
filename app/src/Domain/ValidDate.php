<?php
declare (strict_types=1);

namespace App\Domain;

use DomainException;
use DateTime;
use Exception;

class ValidDate extends DateTime
{
    private function __construct(string $value)
    {
        parent::__construct($value);
    }

    /** @throws Exception */
    public static function convertToDateTime(string $rawDate): self
    {
        if ((new DateTime()) < $rawDate) {
            throw new DomainException('La fecha es mayor que el momento presente.');
        }

        return new self($rawDate);
    }
}
