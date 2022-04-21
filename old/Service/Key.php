<?php

namespace App\Tests\Behat\Service;

class Key
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function parse(): array
    {
        return [$this->value];
    }

    public static function create(string $string): Key
    {
        $value = implode(
            '.',
            explode(
                ' ',
                strtolower($string)
            )
        );

        if (str_contains($value, '.')) {
            $value = '_' . $value;
        }

        return new Key($value);
    }
}