<?php

declare(strict_types=1);

namespace Gambling\TechTest;

use Gambling\Tech\Random;
use PHPUnit\Framework\TestCase;
use Gambling\Tech\Exception\GamblingTechException;
use Gambling\Tech\Exception\InvalidArgumentException;

class RandomTest extends TestCase
{
    /**
     * @throws GamblingTechException
     */
    public function testRandomBytes(): void
    {
        $bytes = [];

        for ($i = 0; $i < 10; ++$i) {
            $bytes[] = Random::getBytes(10);
        }

        self::assertTrue(count(array_unique($bytes)) > 5);
    }

    /**
     * @throws GamblingTechException
     */
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

        Random::getBytes(-1);
    }

    /**
     * @throws GamblingTechException
     */
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

        Random::getInteger(10, 0);
    }

    public function testRandomBoolean(): void
    {
        $boolean = [];

        for ($i = 0; $i < 100; ++$i) {
            $boolean[] = Random::getBoolean();
        }

        self::assertSame(count(array_unique($boolean)), 2);
    }

    /**
     * @throws GamblingTechException
     */
    public function testRandomBooleanValue(): void
    {
        $boolean = Random::getBoolean();

        self::assertTrue($boolean === true || $boolean === false);
    }

    /**
     * @throws GamblingTechException
     */
    public function testRandomFloat(): void
    {
        $numbers = [];

        for ($i = 0; $i < 10; ++$i) {
            $numbers[] = Random::getFloat();
        }

        self::assertTrue(count(array_unique($numbers)) > 5);
    }

    /**
     * @throws GamblingTechException
     */
    public function testRandomString(): void
    {
        $strings = [];

        for ($i = 0; $i < 10; ++$i) {
            $strings[] = Random::getString(32);
        }

        self::assertTrue(count(array_unique($strings)) > 5);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function testRandomStringInvalidLength(): void
    {
        $this->expectException(GamblingTechException::class);

        Random::getString(0);
    }

    /**
     * @throws InvalidArgumentException
     * @throws GamblingTechException
     */
    public function testRandomStringWithCharList(): void
    {
        $charList = str_split('abcde123');
        $strings = [];

        for ($i = 0; $i < 1; ++$i) {
            $strings[] = Random::getString(8, implode($charList));
        }

        $availableChars = true;

        foreach ($strings as $string) {
            $length = mb_strlen($string);
            for ($i = 0; $i < $length; ++$i) {
                $availableChars = in_array($string[$i], $charList, true);
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
