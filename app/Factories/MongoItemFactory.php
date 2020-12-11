<?php

declare (strict_types = 1);
namespace App\Factories;

use App\Entities\Item;
use App\Entities\ValueObjects\ItemType;
use App\Entities\ValueObjects\MongoObjectID;
use App\Factories\Contracts\ItemFactory;
use Psr\Http\Message\ServerRequestInterface as Request;

final class MongoItemFactory implements ItemFactory
{

    public function fromRequest(Request $request): Item
    {
        $requestBody = $request->getParsedBody();

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
