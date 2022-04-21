<?php

declare(strict_types=1);

namespace App\Tests\Behat\Service\Storage;

use App\Tests\Behat\Exception\StorageException;

class Container
{
    public function __construct(
        private KeyEncoder $keyEncoder,
        private array $items = [],
    ) {
    }

    public function set(string $key, mixed $value): void
    {
        $this->items[$this->encodeKey($key)] = $value;
    }

    public function get(string $key): mixed
    {
        if (!isset($this->items[$this->encodeKey($key)])) {
            throw new StorageException("$key does not exist in container");
        }

        return $this->items[$this->encodeKey($key)];
    }

    public function has(string $key): bool
    {
        return isset($this->items[$this->encodeKey($key)]);
    }

    public function remove(string $key): void
    {
        if (isset($this->items[$this->encodeKey($key)])) {
            unset($this->items[$this->encodeKey($key)]);
        }
    }

    public function clear(): void
    {
        $this->items = [];
    }

    private function encodeKey(string $key): string
    {
        return $this->keyEncoder->encode($key);
    }
}