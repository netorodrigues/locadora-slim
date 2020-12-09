<?php
namespace App\Exceptions\ValueObjects;

use RuntimeException;

class InvalidUniqueIdReceivedException extends RuntimeException
{
    public static function handle(string $id): self
    {
        return new self(
            sprintf(
                'Invalid unique id informed: %s',
                $id,
            )
        );
    }
}
