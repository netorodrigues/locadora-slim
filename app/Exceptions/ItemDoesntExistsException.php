<?php

declare (strict_types = 1);
namespace App\Exceptions;

final class ItemDoesntExistsException extends APIException
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
