<?php

declare (strict_types = 1);
namespace App\Exceptions;

final class MissingKeysInRequestException extends APIException
{
    public static function handle(array $keys, array $requiredKeys): self
    {
        return new self(
            sprintf(
                'Not found required keys (%s) in request. Required keys are: (%s)',
                implode(',', $keys),
                implode(',', $requiredKeys)
            )
        );
    }
}
