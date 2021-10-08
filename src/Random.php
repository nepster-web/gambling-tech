<?php

declare(strict_types=1);

namespace Gambling\Tech;

use Exception;
use Gambling\Tech\Exception\InvalidArgumentException;

class Random
{
    /**
     * Generate random bytes using different approaches
     *
     * @param int $length
     * @return string
     * @throws Exception
     */
    public static function getBytes(int $length): string
    {
        return random_bytes($length);
    }

    /**
     * @param int $min
     * @param int $max
     * @return int
     * @throws Exception
     */
    public static function getInteger(int $min, int $max): int
    {
        return random_int($min, $max);
    }

    /**
     * @return bool
     * @throws Exception
     */
    public static function getBoolean(): bool
    {
        $byte = static::getBytes(1);

        return (bool)(ord($byte) % 2);
    }

    /**
     * @return float
     * @throws Exception
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
     * @param array $charlist
     * @return string
     * @throws Exception
     */
    public static function getString(int $length, array $charlist = [])
    {
        if ($length < 1) {
            throw new InvalidArgumentException('Length should be >= 1');
        }

        // charlist is empty or not provided
        if (empty($charlist)) {
            $numBytes = (int)ceil($length * 0.75);
            $bytes = static::getBytes($numBytes);

            return mb_substr(rtrim(base64_encode($bytes), '='), 0, $length, '8bit');
        }

        $listLen = mb_strlen($charlist, '8bit');

        if ($listLen === 1) {
            return str_repeat($charlist, $length);
        }

        $result = '';
        for ($i = 0; $i < $length; $i++) {
            $pos = static::getInteger(0, $listLen - 1);
            $result .= $charlist[$pos];
        }

        return $result;
    }
}
