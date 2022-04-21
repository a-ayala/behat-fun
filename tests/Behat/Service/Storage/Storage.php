<?php

declare(strict_types=1);

namespace App\Tests\Behat\Service\Storage;

class Storage
{
    public function __construct(
        private Container $container,
        private string|null $lastIdentifier = null
    ) {
    }

    public function put(string $identifier, mixed $resource): void
    {
        $this->lastIdentifier = $identifier;
        $this->container->set($this->lastIdentifier, $resource);
    }

    public function retrieve(string $identifier): mixed
    {
        return $this->container->get($identifier);
    }

    public function remove(string $identifier): void
    {
        $this->container->remove($identifier);
    }

    public function contains(string $identifier): bool
    {
        return $this->container->has($identifier);
    }

    public function getLatest(): mixed
    {
        return $this->retrieve($this->lastIdentifier);
    }
}