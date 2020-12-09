<?php
namespace App\Exceptions;

use RuntimeException;

class ItemDoesntExistsException extends RuntimeException
{
    public static function handle(string $itemId): self
    {
        return new self(
            sprintf(
                'Trying to use non-existing item with id: %s',
                $itemId,
            )
        );
    }
}
