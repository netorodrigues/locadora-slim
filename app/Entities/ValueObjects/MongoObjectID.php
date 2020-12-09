<?php

namespace App\Entities\ValueObjects;

use App\Entities\ValueObjects\Contracts\UniqueIDInterface;
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
            return false;
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
