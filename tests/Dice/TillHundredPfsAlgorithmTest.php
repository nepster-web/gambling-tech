<?php

declare(strict_types=1);

namespace Gambling\TechTest\Dice;

use Exception;
use PHPUnit\Framework\TestCase;
use Gambling\Tech\Dice\TillHundredPfsAlgorithm;

class TillHundredPfsAlgorithmTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testGenerateRandomFloatValue(): void
    {
        $serverSeed = hash('sha512', random_bytes(32));
        $clientSeed = random_bytes(7);
        $nonce = 1;

        $number = (new TillHundredPfsAlgorithm)($serverSeed, $clientSeed, $nonce);

        self::assertIsFloat($number);
    }

    /**
     * @throws Exception
     */
    public function testRangeFrom0to100(): void
    {
        $isOutOfRange = false;

        for ($i = 0; $i < 100000; ++$i) {
            $serverSeed = hash('sha512', random_bytes(8));
            $clientSeed = random_bytes(7);
            $nonce = random_int(0, 1000);

            $number = (new TillHundredPfsAlgorithm)($serverSeed, $clientSeed, $nonce);

            if ($number < 0 || $number > 99.99) {
                $isOutOfRange = true;
                break;
            }
        }

        self::assertFalse($isOutOfRange);
    }

    /**
     * @throws Exception
     */
    public function testNoMoreThanATenth(): void
    {
        $isTenth = true;

        for ($i = 0; $i < 100000; ++$i) {
            $serverSeed = hash('sha512', random_bytes(8));
            $clientSeed = random_bytes(7);
            $nonce = random_int(0, 1000);

            $number = (new TillHundredPfsAlgorithm)($serverSeed, $clientSeed, $nonce);

            if (mb_strlen((string)$number) > 5) {
                $isTenth = false;
            }
        }

        self::assertTrue($isTenth);
    }

    public function testPfs(): void
    {
        $serverSeed = '9ed7e4d642988d5a1df8e4b214c2bb12f4e00d0730677d9344c52bc3fc6ced5c9f90079df3507e53aceb0ce6933cabc1524836da1bb7071eda9cff18cfd80ffe';
        $clientSeed = 'my_client_string';
        $nonce = 7;

        $number = (new TillHundredPfsAlgorithm)($serverSeed, $clientSeed, $nonce);

        self::assertEquals(15.33, $number);
    }
}
