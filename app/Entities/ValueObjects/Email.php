<?php

namespace App\Entities\ValueObjects;

use App\Entities\ValueObjects\Contracts\EmailInterface;

class Email implements EmailInterface
{
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

    public static function isValid(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
