<?php

declare(strict_types=1);

namespace Gambling\Tech\Game;

class LuckyNumber
{
    private float $value;

    private SeedPair $seedPair;

    public function __construct(float $value, SeedPair $seedPair)
    {
        $this->value = $value;
        $this->seedPair = $seedPair;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function getSeedPair(): SeedPair
    {
        return $this->seedPair;
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }
}
