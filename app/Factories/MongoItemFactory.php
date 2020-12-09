<?php

namespace App\Factories;

use App\Entities\Item;
use App\Entities\ValueObjects\ItemType;
use App\Entities\ValueObjects\MongoObjectID;
use App\Factories\Contracts\ItemFactory;
use Psr\Http\Message\ServerRequestInterface as Request;

class MongoItemFactory implements ItemFactory
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

        $item->setId(new MongoObjectID($data['id']));
        $item->setType(new ItemType($data['type']));
        $item->setName($data['name']);
        $item->setAvailable($data['available']);

        return $item;
    }
}
