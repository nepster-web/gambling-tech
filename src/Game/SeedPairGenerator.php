<?php

declare(strict_types=1);

namespace Gambling\Tech\Game;

use Gambling\Tech\Random;
use Gambling\Tech\Exception\GamblingTechException;
use Gambling\Tech\Exception\InvalidArgumentException;

class SeedPairGenerator
{
    private StoreInterface $store;

    public function __construct(StoreInterface $store)
    {
        $this->store = $store;
    }

    /**
     * Generation new random seed pair
     *
     * @param string|null $clientSeed
     * @param SeedPair|null $seedPair
     * @return SeedPair
     * @throws GamblingTechException
     * @throws InvalidArgumentException
     */
    public function generate(?string $clientSeed = null, ?SeedPair $seedPair = null): SeedPair
    {
        $serverSeed = $seedPair !== null ? $seedPair->getNextServerSeed() : hash('sha256', Random::getString(32));

        $nextServerSeed = hash('sha256', Random::getString(32));

        if ($clientSeed === null) {
            $clientSeed = $seedPair ?
                $seedPair->getClientSeed() :
                Random::getString(16, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
        }

        $nonce = 1; // each new generation resets nonce

        return $this->createSeedPair($serverSeed, $nextServerSeed, $clientSeed, $nonce);
    }

    /**
     * Get current seed pair or generation new random seed pair
     *
     * @param object $condition
     * @return SeedPair
     * @throws GamblingTechException
     * @throws InvalidArgumentException
     */
    public function getCurrentSeedPairOrGenerate(object $condition): SeedPair
    {
        if ($seed = $this->getCurrentSeedPair($condition)) {
            return $seed;
        }

        return $this->generate();
    }

    /**
     * Get the current active seed by an arbitrary condition
     *
     * @param object $condition
     * @return SeedPair|null
     */
    public function getCurrentSeedPair(object $condition): ?SeedPair
    {
        return $this->store->getCurrentSeedPair($condition);
    }

    /**
     * @param string $serverSeed
     * @param string $nextServerSeed
     * @param string $clientSeed
     * @param int $nonce
     * @return SeedPair
     */
    protected function createSeedPair(
        string $serverSeed,
        string $nextServerSeed,
        string $clientSeed,
        int $nonce
    ): SeedPair {
        return new SeedPair($serverSeed, $nextServerSeed, $clientSeed, $nonce);
    }
}
