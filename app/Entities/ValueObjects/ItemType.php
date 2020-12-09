<?php

namespace App\Entities\ValueObjects;

final class ItemType
{
    public static $possibleValues = ['cd', 'dvd', 'book'];
    private $value;

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
        return in_array($type, self::$possibleValues);
    }
}
