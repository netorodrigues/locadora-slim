<?php
namespace App\Exceptions\ValueObjects;

use App\Exceptions\APIException;

final class InvalidEmailReceivedException extends APIException
{
    public static function handle(string $email): self
    {
        return new self(
            sprintf(
                'Invalid email informed: %s',
                $email,
            ), 400
        );
    }
}
