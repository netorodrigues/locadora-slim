<?php

declare (strict_types = 1);
namespace App\Factories;

use App\Entities\Item;
use App\Entities\ValueObjects\ItemType;
use App\Entities\ValueObjects\MongoObjectID;
use App\Exceptions\MissingKeysInRequestException;
use App\Factories\Contracts\ItemFactoryInterface;
use Psr\Http\Message\ServerRequestInterface as Request;

final class ItemFactory implements ItemFactoryInterface
{

    public function fromRequest(Request $request, array $requiredKeys): Item
    {
        $requestBody = $request->getParsedBody();

        $missingKeys = array_diff($requiredKeys, array_keys($requestBody));

        if (!empty($missingKeys)) {
            throw MissingKeysInRequestException::handle($missingKeys, $requiredKeys);
        }

        $item = new Item;
        $item->setType(new ItemType($requestBody['type']));
        $item->setName($requestBody['name']);
        $item->setAvailable(true);

        return $item;

    }

    public function fromArray(array $data): Item
    {
        $item = new Item;

        if (array_key_exists('id', $data)) {
            $item->setId(new MongoObjectID($data['id']));
        }

        if (array_key_exists('type', $data)) {
            $item->setType(new ItemType($data['type']));
        }

        if (array_key_exists('name', $data)) {
            $item->setName($data['name']);
        }

        if (array_key_exists('available', $data)) {
            $item->setAvailable($data['available']);
        }

        return $item;
    }
}
