<?php
namespace App\Exceptions;

use RuntimeException;

class ItemUnavailableException extends RuntimeException
{
    public static function handle(string $itemId): self
    {
        return new self(
            sprintf(
                'Trying to use unavailable item with id: %s',
                $itemId,
            )
        );
    }
}
