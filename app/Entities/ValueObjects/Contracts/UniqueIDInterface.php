<?php

namespace App\Entities\ValueObjects\Contracts;

interface UniqueIDInterface
{
    public function getValue(): string;

    public static function isValid(string $id): bool;
}
