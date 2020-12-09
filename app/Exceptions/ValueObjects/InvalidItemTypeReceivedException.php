<?php
namespace App\Exceptions\ValueObjects;

use App\Entities\ValueObjects\ItemType;
use RuntimeException;

class InvalidItemTypeReceivedException extends RuntimeException
{
    public static function handle(string $type): self
    {
        return new self(
            sprintf(
                'Invalid item type informed: %s. possible types are: (%s)',
                $type,
                implode(',', ItemType::$possibleValues)
            )
        );
    }
}
