<?php

declare (strict_types = 1);
namespace App\Exceptions;

final class ItemUnavailableException extends APIException
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
