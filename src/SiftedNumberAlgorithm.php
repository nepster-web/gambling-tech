<?php

declare(strict_types=1);

namespace Gambling\Tech;

class SiftedNumberAlgorithm
{
    private float $min = 0;

    private float $max = 100;

    private string $serverSeed;

    private string $clientSeed;

    /**
     * @param float $number
     * @return int
     */
    public function __invoke(float $number): int
    {
        $clientHash = $this->getClientHash($number);
        $shiftValue = $this->getShiftValue($clientHash);

        return $this->shift($number, $shiftValue);
    }

    /**
     * @param float $min
     * @return $this
     */
    public function setMin(float $min): self
    {
        $this->min = $min;

        return $this;
    }

    /**
     * @param float $max
     * @return $this
     */
    public function setMax(float $max): self
    {
        $this->max = $max;

        return $this;
    }

    /**
     * @param float $number
     * @param int $shift
     * @return int
     */
    protected function shift(float $number, int $shift): int
    {
        if ($shift > $this->max) {
            $shift %= ($this->max - $this->min + 1);
        }

        return $number + $shift <= $this->max ?
            $number + $shift :
            $this->min + ($number + $shift - $this->max) - 1;
    }

    /**
     * @param float $secret
     * @return string
     */
    protected function getClientHash(float $secret): string
    {
        return hash_hmac('sha256', (string)$secret . $this->serverSeed, $this->clientSeed);
    }

    /**
     * @param string $clientHash
     * @return int
     */
    protected function getShiftValue(string $clientHash): int
    {
        return (int)hexdec(substr($clientHash, -5));
    }
}
