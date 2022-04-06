<?php
declare(strict_types=1);

namespace App\Domain\Company;

use App\Domain\ValidDate;
use DateTime;
use Exception;

class Company
{
    protected $id;
    protected $name;
    protected $foundedOn;
    protected $location;

    /** @throws Exception */
    public function __construct(int $id, string $name, string $foundedOn, string $location)
    {
        $this->id = $id;
        $this->name = $name;
        $this->location = Location::buildFromString($location);
        $this->foundedOn = ValidDate::convertToDateTime($foundedOn);
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
}
