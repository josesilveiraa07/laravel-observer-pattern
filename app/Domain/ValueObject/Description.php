<?php

namespace App\Domain\ValueObject;

use InvalidArgumentException;

class Description
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

    private function validate(string $description): void
    {
        if(strlen($description) === 0 || strlen($description) > 1000) {
            throw new InvalidArgumentException('Description must be between 1 and 1000 characters.');
        }
    }
}
