<?php

declare(strict_types=1);

namespace Gambling\TechTest;

use Gambling\Tech\Random;
use PHPUnit\Framework\TestCase;
use Gambling\Tech\Exception\GamblingTechException;

class RandomTest extends TestCase
{
    public function testRandomBytes(): void
    {
        $bytes = [];

        for ($i = 0; $i < 10; ++$i) {
            $bytes[] = Random::getBytes(10);
        }

        self::assertTrue(count(array_unique($bytes)) > 5);
    }

    public function testRandomBytesLength(): void
    {
        self::assertEquals(1, mb_strlen(Random::getBytes(1), '8bit'));
        self::assertEquals(5, mb_strlen(Random::getBytes(5), '8bit'));
        self::assertEquals(7, mb_strlen(Random::getBytes(7), '8bit'));
        self::assertEquals(10, mb_strlen(Random::getBytes(10), '8bit'));
        self::assertEquals(11, mb_strlen(Random::getBytes(11), '8bit'));
        self::assertEquals(150, mb_strlen(Random::getBytes(150), '8bit'));
    }

    public function testRandomBytesInvalidLength(): void
    {
        $this->expectException(GamblingTechException::class);

        $bytes = Random::getBytes(-1);
    }

    public function testRandomInteger(): void
    {
        $numbers = [];

        for ($i = 0; $i < 10; ++$i) {
            $numbers[] = Random::getInteger(0, 100000);
        }

        self::assertTrue(count(array_unique($numbers)) > 5);
    }

    public function testRandomIntegerInvalidLength(): void
    {
        $this->expectException(GamblingTechException::class);

        $number = Random::getInteger(10, 0);
    }

    public function testRandomBoolean(): void
    {
        $boolean = [];

        for ($i = 0; $i < 100; ++$i) {
            $boolean[] = Random::getBoolean();
        }

        self::assertTrue(count(array_unique($boolean)) === 2);
    }

    public function testRandomBooleanValue(): void
    {
        $boolean = Random::getBoolean();

        self::assertTrue($boolean === true || $boolean === false);
    }

    public function testRandomFloat(): void
    {
        $numbers = [];

        for ($i = 0; $i < 10; ++$i) {
            $numbers[] = Random::getFloat();
        }

        self::assertTrue(count(array_unique($numbers)) > 5);
    }

    public function testRandomString(): void
    {
        $strings = [];

        for ($i = 0; $i < 10; ++$i) {
            $strings[] = Random::getString(32);
        }

        self::assertTrue(count(array_unique($strings)) > 5);
    }

    public function testRandomStringInvalidLength(): void
    {
        $this->expectException(GamblingTechException::class);

        $number = Random::getString(0);
    }

    public function testRandomStringWithCharlist(): void
    {
        $charlist = str_split('abcde123');
        $strings = [];

        for ($i = 0; $i < 1; ++$i) {
            $strings[] = Random::getString(8, implode($charlist));
        }

        $availableChars = true;

        foreach ($strings as $string) {
            $length = mb_strlen($string);
            for ($i = 0; $i < $length; ++$i) {
                $assert = in_array($string[$i], $charlist);
                if ($availableChars === false) {
                    break;
                }
            }
            if ($availableChars === false) {
                break;
            }
        }

        self::assertTrue($availableChars);
    }
}
