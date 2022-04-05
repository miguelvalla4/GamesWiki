<?php
declare(strict_types=1);

namespace App\Domain\Game;

use App\Domain\Company\Company;
use App\Domain\System\System;
use App\Domain\ValidDate;
use DateTime;
use Exception;
use JsonSerializable;


class Game implements JsonSerializable
{
    protected $id;
    protected $title;
    protected $type;
    protected $releasedOn;
    protected $company;
    protected $system;
    protected $tags;


    /** @throws Exception */
    public function __construct(int $id, string $title, string $type, string $releasedOn, Company $company, System $system)
    {
        $this->id = $id;
        $this->title = $title;
        $this->type = $type;
        $this->releasedOn = ValidDate::convertToDateTime($releasedOn);
        $this->company = $company;
        $this->system = $system;

        $this->setTags();
    }
    private function setTags(): void
    {
        $this->setTagByCountry();

        $this->setTagByType();

        $this->setTagByReleasedDate();
    }

    private function setTagByCountry(): void
    {
        if ('Japón' === $this->company->getLocation()->getCountry()) {
            $this->tags[] = Tag::buildTagByCountry();
        }
    }

    private function setTagByType(): void
    {
        if ($this->getType() === 'Lucha' || $this->getType() === 'Beat \'em up') {
            $this->tags[] = Tag::buildTagByType();
        }
    }

    private function setTagByReleasedDate(): void
    {
        if ($this->getReleasedOn() <= new DateTime('-20 year') &&
            $this->getReleasedOn() > new DateTime('-30 year')) {
            $this->tags[] = Tag::buildTagVintage();
        }

        if ($this->getReleasedOn() <= new DateTime('-30 year')) {
            $this->tags[] = Tag::buildTagOldieButGoldie();
        }
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getReleasedOn(): DateTime
    {
        return $this->releasedOn;
    }

    public function getCompany_Id(): int
    {
        return $this->company->getId();
    }

    public function getSystem_Id(): int
    {
        return $this->system->getId();
    }

    public function jsonSerialize(): array
    {
        return [
            "id" => $this->getId(),
            "title" => $this->getTitle(),
            "type" => $this->getType(),
            "released_on" => $this->releasedOn->format('Y-m-d'),
            "company" => $this->company->getName(),
            "system" => $this->system->getName(),
            "tags" => $this->getTags()
        ];
    }
}
