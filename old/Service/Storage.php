<?php

declare(strict_types=1);

namespace App\Tests\Behat\Service;

class Storage
{
    private Store $store;

    private Key|null $latestKey;

    public function __construct()
    {
        $this->store = new Store;
        $this->latestKey = null;
    }

    public function set(string $key, mixed $value): void
    {
        $this->latestKey = Key::create($key);
        $this->store->set($this->latestKey, $value);
    }

    public function get(string $key): mixed
    {
        return $this->store->get(Key::create($key));
    }

    public function delete(string $key): void
    {
        $this->store->delete(Key::create($key));
    }

    public function getLatest(): mixed
    {
        return $this->get($this->latestKey->value());
    }

    public function has(string $key): bool
    {
        return $this->store->has(Key::create($key));
    }
}