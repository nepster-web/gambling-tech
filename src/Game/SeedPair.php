<?php

declare(strict_types=1);

namespace Gambling\Tech\Game;

class SeedPair
{
    private string $serverSeed;

    private string $nextServerSeed;

    private string $clientSeed;

    private int $nonce;

    public function __construct(
        string $serverSeed,
        string $nextServerSeed,
        string $clientSeed,
        int $nonce
    ) {
        $this->serverSeed = $serverSeed;
        $this->nextServerSeed = $nextServerSeed;
        $this->clientSeed = $clientSeed;
        $this->nonce = $nonce;
    }

    public static function increment(self $seedPair): self
    {
        return new self(
            $seedPair->getServerSeed(),
            $seedPair->getNextServerSeed(),
            $seedPair->getClientSeed(),
            $seedPair->getNonce() + 1
        );
    }

    public function getServerSeed(): string
    {
        return $this->serverSeed;
    }

    public function getNextServerSeed(): string
    {
        return $this->nextServerSeed;
    }

    public function getClientSeed(): string
    {
        return $this->clientSeed;
    }

    public function getNonce(): int
    {
        return $this->nonce;
    }
}
