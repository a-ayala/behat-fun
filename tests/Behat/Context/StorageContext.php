<?php

declare(strict_types=1);

namespace App\Tests\Behat\Context;

use App\Tests\Behat\Service\Storage\Storage;
use Behat\Behat\Context\Context;

class StorageContext implements Context
{
    private Storage $storage;

    public function __construct(
        Storage $storage
    ) {
        $this->storage = $storage;
    }

    /**
     * @Transform /^(?:this|that|the) ([^"]+)$/
     */
    public function getResource($identifier)
    {
        return $this->storage->retrieve($identifier);
    }

    /**
     * @Transform /^(?:it|its|they)$/
     */
    public function getLatestResource()
    {
        return $this->storage->getLatest();
    }

    /**
     * @Given /^i dump the store$/
     */
    public function iDumpTheStore()
    {
        dd($this->storage);
    }
}
