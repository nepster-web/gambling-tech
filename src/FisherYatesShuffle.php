<?php

declare(strict_types=1);

namespace Gambling\Tech;

use Gambling\Tech\Exception\GamblingTechException;

/**
 * The Fisher Yates shuffle, read more about it here
 * https://en.wikipedia.org/wiki/Fisher%E2%80%93Yates_shuffle
 */
class FisherYatesShuffle
{
    /**
     * @param array $array
     * @return array
     * @throws GamblingTechException
     */
    public function __invoke(array $array): array
    {
        foreach ($array as $i => $iValue) {
            $r = Random::getInteger(0, $i);
            $tmp = $iValue;
            $array[$i] = $array[$r];
            $array[$r] = $tmp;
        }

        return $array;
    }
}
