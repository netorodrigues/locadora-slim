<?php
namespace App\Exceptions\ValueObjects;

use RuntimeException;

class InvalidEmailReceivedException extends RuntimeException
{
    public static function handle(string $email): self
    {
        return new self(
            sprintf(
                'Invalid email informed: %s',
                $email,
            )
        );
    }
}
