<?php

declare(strict_types=1);

namespace Gambling\Tech\Game;

class SeedPair
{
    private string $serverSeed;
    private string $nextServerSeed;
    private string $clientSeed;

    public function __construct(
        string $serverSeed,
        string $nextServerSeed,
        string $clientSeed
    ) {
        $this->serverSeed = $serverSeed;
        $this->nextServerSeed = $nextServerSeed;
        $this->clientSeed = $clientSeed;
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
}
