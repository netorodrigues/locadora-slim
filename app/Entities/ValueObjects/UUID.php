<?php

declare (strict_types = 1);
namespace App\Entities\ValueObjects;

use App\Entities\ValueObjects\Contracts\UniqueIDInterface;
use App\Exceptions\ValueObjects\InvalidUniqueIdReceivedException;

final class UUID implements UniqueIDInterface
{
    protected $value;
    private const REGEX = '/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i';

    public function __construct(string $value)
    {
        if (!self::isValid($value)) {
            throw InvalidUniqueIdReceivedException::handle($value);
        }

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public static function isValid(string $uuid): bool
    {
        return filter_var($uuid, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => self::REGEX]]) !== false;
    }
}
