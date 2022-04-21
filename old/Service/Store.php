<?php

declare(strict_types=1);

namespace App\Tests\Behat\Service;

use App\Tests\Behat\Exception\StorageException;

class Store
{
    private array $items;

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function set(Key $key, mixed $value): void
    {
        $ref = &$this->items;

        foreach ($key->parse() as $k) {
            $ref = &$ref[$k];
        }

        $ref = $value;
    }

    public function get(Key $key): mixed
    {
        $ref = &$this->items;
        foreach ($key->parse() as $k) {
            if (!isset($ref[$k])) {
                // @todo make the $key in the exception relative to where we are in the original string
                throw new StorageException("$key does not exist in storage");
            }
            $ref = &$ref[$k];
        }

        return $ref;
    }

    public function has(Key $key): bool
    {
        $ref = &$this->items;
        foreach ($key->parse() as $k) {
            if (!isset($ref[$k])) {
                return false;
            }
            $ref = &$ref[$k];
        }

        return true;
    }

    public function delete(Key $key): void
    {
        $ref = &$this->items;
        $keys = $key->parse();
        foreach ($keys as $index => $k) {
            if (!isset($ref[$k])) {
                // @todo make the $key in the exception relative to where we are in the original string
                throw new StorageException("$key does not exist in storage");
            }

            if ($index === array_key_last($keys)) {
                unset($ref[$k]);

                return;
            }
            $ref = &$ref[$k];
        }
    }

    public function clear(): void
    {
        $this->items = [];
    }
}