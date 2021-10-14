<?php

declare(strict_types=1);

namespace Gambling\Tech;

use Throwable;
use ValueError;
use Gambling\Tech\Exception\GamblingTechException;
use Gambling\Tech\Exception\InvalidArgumentException;

class Random
{
    /**
     * Generate random bytes using different approaches
     *
     * @param int $length
     * @return string
     * @throws GamblingTechException
     */
    public static function getBytes(int $length): string
    {
        try {
            return random_bytes($length);
        } catch (Throwable $e) {
            if ($e instanceof ValueError) {
                throw new InvalidArgumentException($e->getMessage(), 0, $e);
            }

            throw new GamblingTechException($e->getMessage(), 0, $e);
        }
    }

    /**
     * @param int $min
     * @param int $max
     * @return int
     * @throws GamblingTechException
     */
    public static function getInteger(int $min, int $max): int
    {
        try {
            return random_int($min, $max);
        } catch (Throwable $e) {
            if ($e instanceof ValueError) {
                throw new InvalidArgumentException($e->getMessage(), 0, $e);
            }

            throw new GamblingTechException($e->getMessage(), 0, $e);
        }
    }

    /**
     * @return bool
     * @throws GamblingTechException
     */
    public static function getBoolean(): bool
    {
        $byte = static::getBytes(1);

        return (bool)(ord($byte) % 2);
    }

    /**
     * @return float
     * @throws GamblingTechException
     */
    public static function getFloat(): float
    {
        $bytes = static::getBytes(7);

        $bytes[6] = $bytes[6] | chr(0xF0);
        $bytes .= chr(63); // exponent bias (1023)
        $float = unpack('d', $bytes)[1];

        return ($float - 1);
    }

    /**
     * @param int $length
     * @param string|null $charList
     * @return string
     * @throws GamblingTechException
     * @throws InvalidArgumentException
     */
    public static function getString(int $length, ?string $charList = null): string
    {
        if ($length < 1) {
            throw new InvalidArgumentException('Length should be >= 1');
        }

        // charList is empty or not provided
        if (empty($charList)) {
            $numBytes = (int)ceil($length * 0.75);
            $bytes = static::getBytes($numBytes);

            return mb_substr(rtrim(base64_encode($bytes), '='), 0, $length, '8bit');
        }

        $listLen = mb_strlen($charList, '8bit');

        if ($listLen === 1) {
            return str_repeat($charList, $length);
        }

        $result = '';
        for ($i = 0; $i < $length; $i++) {
            $pos = static::getInteger(0, $listLen - 1);
            $result .= $charList[$pos];
        }

        return $result;
    }
}
