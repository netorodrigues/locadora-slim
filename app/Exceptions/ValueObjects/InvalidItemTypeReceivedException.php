<?php
namespace App\Exceptions\ValueObjects;

use App\Entities\ValueObjects\ItemType;
use App\Exceptions\APIException;

final class InvalidItemTypeReceivedException extends APIException
{
    public static function handle(string $type): self
    {
        return new self(
            sprintf(
                'Invalid item type informed: %s. possible types are: (%s)',
                $type,
                implode(',', ItemType::$possibleValues)
            ), 400
        );
    }
}
