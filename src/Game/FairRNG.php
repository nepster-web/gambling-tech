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
     * @return LuckyNumber
     * @throws GamblingTechException
     * @throws InvalidArgumentException
     */
    public function __invoke(object $condition): LuckyNumber
    {
        $seedPair = $this->seedPairGenerator->getCurrentSeedPairOrGenerate($condition);

        $seedPair = SeedPair::increment($seedPair);

        $luckyNumber = (new RngTillHundred())(
            $seedPair->getServerSeed(),
            $seedPair->getClientSeed(),
            $seedPair->getNonce()
        );

        return new LuckyNumber($luckyNumber, $seedPair);
    }
}
