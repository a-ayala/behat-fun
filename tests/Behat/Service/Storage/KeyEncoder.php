<?php

namespace App\Tests\Behat\Service\Storage;

class KeyEncoder
{
    public function encode(string $key): string
    {
        return strtolower(str_replace(' ', '.', $key));
    }
}