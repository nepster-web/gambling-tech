<?php

declare(strict_types=1);

namespace Gambling\TechTest;

use PHPUnit\Framework\TestCase;
use Gambling\Tech\FisherYatesShuffle;
use Gambling\Tech\Exception\GamblingTechException;

class FisherYatesShuffleTest extends TestCase
{
    /**
     * @throws GamblingTechException
     */
    public function testSuccessSendMessage(): void
    {
        $array = [
            1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16,
            17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32
        ];

        $sorted = (new FisherYatesShuffle)($array);

        self::assertNotEquals($array, $sorted);
    }
}
