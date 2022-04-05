<?php
declare(strict_types=1);

namespace App\Domain\Game;

use JsonSerializable;

class Tag implements JsonSerializable
{
    protected $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function buildTagByCountry(): self
    {
        return new self('Nipón');
    }

    public static function buildTagByType(): self
    {
        return new self('Machacabotones');
    }

    public static function buildTagVintage(): self
    {
        return new self('Vintage');
    }

    public static function buildTagOldieButGoldie(): self
    {
        return new self('Oldie but Goldie');
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function jsonSerialize(): string
    {
        return $this->value;
    }
}
