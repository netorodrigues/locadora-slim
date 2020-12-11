<?php

declare (strict_types = 1);
namespace App\Entities\ValueObjects\Contracts;

interface UniqueIDInterface
{
    public function getValue(): string;

    public static function isValid(string $id): bool;
}
