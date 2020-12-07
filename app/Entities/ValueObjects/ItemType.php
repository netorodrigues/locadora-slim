<?php

namespace App\Entities\ValueObjects;

class ItemType
{
    private $possibleValues = ['cd', 'dvd', 'book'];
    protected $value;

    public function __construct(string $value)
    {
        if (!self::isValid($value)) {
            return false;
        }

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public static function isValid(string $type): bool
    {
        return in_array($value, self::possibleValues);
    }
}
