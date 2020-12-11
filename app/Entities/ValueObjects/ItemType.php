<?php

declare (strict_types = 1);
namespace App\Entities\ValueObjects;

use App\Exceptions\ValueObjects\InvalidItemTypeReceivedException;

final class ItemType
{
    public static $possibleValues = ['cd', 'dvd', 'book'];
    private $value;

    public function __construct(string $value)
    {
        if (!self::isValid($value)) {
            throw InvalidItemTypeReceivedException::handle($value);
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
