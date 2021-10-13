<?php

declare(strict_types=1);

namespace Gambling\Tech\Dice;

/**
 * RNG with PFS for DICE (in the range from 0 to 99.99)
 *
 * Provably fair system is an algorithm based on technologies that allow online
 * randomization to step up and reach a new level of fairness and openness.
 *
 * More about provably fair system (PFS):
 * https://www.provably.com
 *
 *
 * JS alternative:
 *
 * const luckyNumber = (({
 *     serverSeed,
 *     clientSeed,
 *     nonce
 * }) => {
 *   const hash = sha512.hmac(serverSeed, `${clientSeed}-${nonce}`);
 *   let offset = 0, number = 0;
 *   do {
 *     number = parseInt(hash.substr(offset, 5), 16);
 *     offset += 5;
 *   }
 *   while (number >= 1000000);
 *
 *   return (number % 10000) / 100;
 * });
 */
class TillHundredPfsAlgorithm
{
    /**
     * Generates a number in the range 0 to 99.99
     *
     * @param string $serverSeed
     * @param string $clientSeed
     * @param int $nonce
     * @return float
     */
    public function __invoke(string $serverSeed, string $clientSeed, int $nonce): float
    {
        $hash = hash_hmac('sha512', "${clientSeed}-${nonce}", $serverSeed);
        $offset = 0;

        do {
            $number = hexdec(mb_substr($hash, $offset, 5));
            $offset += 5;
        } while ($number >= 1000000);

        return ($number % 10000) / 100;
    }
}
