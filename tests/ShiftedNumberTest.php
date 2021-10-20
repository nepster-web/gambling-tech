<?php

declare(strict_types=1);

namespace Gambling\TechTest;

use Gambling\Tech\ShiftedNumber;
use PHPUnit\Framework\TestCase;

class ShiftedNumberTest extends TestCase
{
    public function testShiftedNumber(): void
    {
        $hash = sha1('hash');
        $number = (new ShiftedNumber())(7, $hash);

        self::assertNotEquals(7, $number);
    }

    public function testReproduceShiftedNumber(): void
    {
        $hash = sha1('hash');
        $number = (new ShiftedNumber())(7, $hash);

        self::assertEquals(1, $number);
    }

    public function testMinLimit(): void
    {
        $min = 100;
        $pinpoint = false;

        for ($i = 0; $i < 100; ++$i) {
            $number = ((new ShiftedNumber())
                ->setMin($min)->setMax(1000))($i, sha1(uniqid('', true)));
            if ($min > $number) { echo $number . ' ';
                $pinpoint = true;
            }
        }

        self::assertFalse($pinpoint);
    }

    public function testMaxLimit(): void
    {
        $max = 1000;
        $pinpoint = false;

        for ($i = 0; $i < 100; ++$i) {
            $number = ((new ShiftedNumber())
                ->setMin(100)->setMax($max))($i, sha1(uniqid('', true)));
            if ($number > $max) {
                $pinpoint = true;
            }
        }

        self::assertFalse($pinpoint);
    }

    public function testShiftedNumberByRandomString(): void
    {
        $number = (new ShiftedNumber())(7, 'my_random_string');

        self::assertNotEquals(7, $number);
    }
}
