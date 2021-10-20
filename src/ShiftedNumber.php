<?php

declare(strict_types=1);

namespace Gambling\Tech;

use ErrorException;
use Exception;

/**
 * Base value shifting by hash
 */
class ShiftedNumber
{
    private int $min = 0;

    private int $max = 100;

    /**
     * @param float $number
     * @param string $hash
     * @return int
     */
    public function __invoke(float $number, string $hash): int
    {
        $shiftValue = $this->getShiftValue($hash);

        return (int)$this->shift($number, $shiftValue);
    }

    /**
     * @param int $min
     * @return $this
     */
    public function setMin(int $min): self
    {
        $this->min = $min;

        return $this;
    }

    /**
     * @param int $max
     * @return $this
     */
    public function setMax(int $max): self
    {
        $this->max = $max;

        return $this;
    }

    /**
     * @param float $number
     * @param int $shift
     * @return float
     */
    protected function shift(float $number, int $shift): float
    {
        if ($shift > $this->max) {
            $shift %= ($this->max - $this->min + 1);
        }

        $shift = $shift === 0 ? (int)(7 / 100 * $this->max) : $shift;

        $result = $number + $shift <= $this->max ?
            $number + $shift :
            $this->min + ($number + $shift - $this->max) - 1;

        if ($result < $this->min || $result > $this->max) {
            $float = round(($this->min / ($this->max + 1)) + M_PI, 5);
            $percent = (int)mb_substr((string)$float, -2, 2);
            $result = ($this->min === 0 ? $this->max / 2 : $this->min) + ($percent / 100 * $this->min);
            $result = $result > $this->max ? $this->max : $result;
        }

        return $result;
    }

    /**
     * @param string $hash
     * @return int
     */
    protected function getShiftValue(string $hash): int
    {
        if (preg_match("/^([a-f0-9])$/", $hash) === 0) {
            $hash = sha1($hash);
        }

        return (int)hexdec(mb_substr($hash, -5));
    }
}
