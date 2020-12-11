<?php

declare (strict_types = 1);
namespace App\Entities\ValueObjects;

use App\Entities\ValueObjects\Contracts\EmailInterface;
use App\Exceptions\ValueObjects\InvalidEmailReceivedException;

final class Email implements EmailInterface
{
    private $value;

    public function __construct(string $value)
    {
        if (!self::isValid($value)) {
            throw InvalidEmailReceivedException::handle($value);
        }

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public static function isValid(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
}
