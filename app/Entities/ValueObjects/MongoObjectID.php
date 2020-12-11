<?php

declare (strict_types = 1);
namespace App\Entities\ValueObjects;

use App\Entities\ValueObjects\Contracts\UniqueIDInterface;
use App\Exceptions\ValueObjects\InvalidUniqueIdReceivedException;
use \MongoDB\BSON\ObjectId;

final class MongoObjectID implements UniqueIDInterface
{
    private $value;
    private const MONGO_REGEX = '/^[a-f\d]{24}$/i';

    public function __construct(?string $value)
    {
        if (!$value) {
            $value = (string) new ObjectId();
        }
        if (!self::isValid($value)) {
            throw InvalidUniqueIdReceivedException::handle($value);
        }

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public static function isValid(string $id): bool
    {
        return preg_match(self::MONGO_REGEX, $id);
    }
}
