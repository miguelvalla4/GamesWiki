<?php
declare(strict_types=1);

namespace App\Domain\Company;

use InvalidArgumentException;

class Location
{
    protected $city;
    protected $country;

    private function __construct(string $city, string $country)
    {
        $this->city = $city;
        $this->country = $country;
    }

    public static function buildFromString(string $rawLocation): self
    {
        if (false === strpos($rawLocation, ',')) {
            throw new InvalidArgumentException('El formato de la localización no es válido');
        }

        $components = explode(',', $rawLocation);

        return new self(trim($components[0]), trim($components[1]));
    }

    public function getCountry(): string
    {
        return $this->country;
    }
}
