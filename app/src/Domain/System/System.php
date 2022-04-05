<?php
declare(strict_types=1);

namespace App\Domain\System;

use App\Domain\Company\Company;
use App\Domain\ValidDate;
use Exception;

class System
{
    protected $id;
    protected $name;
    protected $description;
    protected $generation;
    protected $releasedOn;
    protected $company;

    /** @throws Exception */
    public function __construct(int $id, string $name, string $description, string $generation, string $releasedOn, Company $company)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->generation = $generation;
        $this->company = $company;
        $this->releasedOn = ValidDate::convertToDateTime($releasedOn);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function isSameSystemId (System $otherSystem): bool
    {
        return $this->id === $otherSystem->getId();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getGeneration(): string
    {
        return $this->generation;
    }

    public function getReleasedOn(): ValidDate
    {
        return $this->releasedOn;
    }

    public function getCompany(): Company
    {
        return $this->company;
    }
}
