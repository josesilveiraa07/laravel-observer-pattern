<?php

namespace App\Domain\ValueObject;

use InvalidArgumentException;

class Title
{
    private string $value;

    public function __construct(string $value)
    {
        $this->validate($value);

        $this->value = $value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value): void
    {
        $this->validate($value);

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    private function validate($title): void
    {
        if(strlen($title) === 0 || strlen($title) > 255) {
            throw new InvalidArgumentException('Title must be between 1 and 255 characters.');
        }
    }
}
