<?php
declare(strict_types=1);

namespace App\Domain\Company;

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
        $components = explode(',', $rawLocation);

        return new self(trim($components[0]), trim($components[1]));
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function equals(Location $otherLocation): bool
    {
        return $this->isSameCity($otherLocation) &&
            $this->isSameCountry($otherLocation);
    }

    public function isSameCountry(Location $otherLocation): bool
    {
        return $this->country === $otherLocation->getCountry();
    }

    public function isSameCity(Location $otherLocation): bool
    {
        return $this->city === $otherLocation->getCity();
    }

    public function getLocation(): string
    {
        return $this->city . ', ' . $this->country;
    }

    public function __toString(): string
    {
        return $this->getLocation();
    }
}
