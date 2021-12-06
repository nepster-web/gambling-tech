<?php

declare(strict_types=1);

namespace Gambling\Tech\Game;

interface StoreInterface
{
    public function getCurrentSeedPair(object $condition): ?SeedPair;
}
