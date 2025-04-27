<?php

namespace App\Domain\ValueObject;

use InvalidArgumentException;
use Random\RandomException;

class UUID
{
    private string $value;

    public function __construct(string $value)
    {
        $this->validate($value);

        $this->value = $value;
    }

    /**
     * @throws RandomException
     */
    public static function random(): UUID
    {
        $value = self::generate();

        return new self($value);
    }

    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value): void
    {
        $this->validate($value);

        $this->value = $value;
    }

    private function validate(string $uuid): void
    {
        if(!preg_match('/^[a-f\d]{8}(-[a-f\d]{4}){4}[a-f\d]{8}$/i', $uuid))
        {
            throw new InvalidArgumentException('Invalid UUID format.');
        }
    }

    /**
     * @throws RandomException
     */
    private static function generate(): string
    {
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

        return vsprintf('xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx', str_split(bin2hex($data), 4));
    }
}
