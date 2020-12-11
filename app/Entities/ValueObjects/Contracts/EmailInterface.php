<?php

declare (strict_types = 1);
namespace App\Entities\ValueObjects\Contracts;

interface EmailInterface
{
    public function getValue(): string;

    public static function isValid(string $email): bool;
}
