<?php

declare(strict_types=1);

namespace Gambling\Tech\Game;

use Gambling\Tech\Dice\RngTillHundred;
use Gambling\Tech\Exception\GamblingTechException;
use Gambling\Tech\Exception\InvalidArgumentException;

class FairRNG
{
    private SeedPairGenerator $seedPairGenerator;

    /**
     * @param SeedPairGenerator $seedPairGenerator
     */
    public function __construct(SeedPairGenerator $seedPairGenerator)
    {
        $this->seedPairGenerator = $seedPairGenerator;
    }

    /**
     * @param object $condition
     * @param int $nonce
     * @param callable $callback
     * @return object
     * @throws GamblingTechException
     * @throws InvalidArgumentException
     */
    public function __invoke(object $condition, int $nonce, callable $callback): object
    {
        $seedPair = $this->seedPairGenerator->generationIfNeeded($condition);

        $luckyNumber = $this->generateLuckyNumber($seedPair, $nonce);

        return $callback($luckyNumber, $seedPair);
    }

    /**
     * @param SeedPair $seedPair
     * @param int $nonce
     * @return float
     */
    protected function generateLuckyNumber(SeedPair $seedPair, int $nonce): float
    {
        return (new RngTillHundred())($seedPair->getServerSeed(), $seedPair->getClientSeed(), $nonce);
    }
}
