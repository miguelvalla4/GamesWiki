<?php
declare(strict_types=1);

namespace App\Domain\Company;

use DateTime;
use DomainException;

class Company
{
    protected $id;
    protected $name;
    protected $foundedOn;
    protected $location;

    public function __construct(int $id, string $name, DateTime $foundedOn, string $location)
    {
        $this->id = $id;
        $this->name = $name;
        $this->location = Location::buildFromString($location);

        $this->setFoundedOn($foundedOn);
    }

    private function setFoundedOn(DateTime $foundedOn): void
    {
        if ((new DateTime()) < $foundedOn) {
            throw new DomainException('La fecha es mayor que el momento presente.');
        }

        $this->foundedOn = $foundedOn;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getFoundedOn(): DateTime
    {
        return $this->foundedOn;
    }

    public function getLocation(): Location
    {
        return $this->location;
    }

    public function isFromSameLocation(Company $anotherCompany): bool
    {
        return $this->isFromSameCountry($anotherCompany)
            && $this->isFromSameCity($anotherCompany);
    }

    public function isFromSameCountry(Company $anotherCompany): bool
    {
        return $this->location->isSameCountry($anotherCompany->getLocation());
    }

    public function isFromSameCity(Company $anotherCompany): bool
    {
        return $this->location->isSameCity($anotherCompany->getLocation());
    }
}
