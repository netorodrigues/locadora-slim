<?php
namespace App\Exceptions\ValueObjects;

use App\Exceptions\APIException;

final class InvalidUniqueIdReceivedException extends APIException
{
    public static function handle(string $id): self
    {
        return new self(
            sprintf(
                'Invalid unique id informed: %s',
                $id,
            ), 400
        );
    }
}
