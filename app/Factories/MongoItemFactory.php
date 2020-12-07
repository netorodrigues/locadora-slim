<?php

namespace App\Factories;

use App\Entities\Item;
use App\Entities\ValueObjects\ItemType;
use App\Entities\ValueObjects\MongoObjectID;
use Psr\Http\Message\ServerRequestInterface as Request;

class MongoItemFactory implements ItemFactoryInterface
{

    public function fromRequest(Request $request): Item
    {
        $requestBody = $request->getParsedBody();

        $item = new Item;
        $item->setId(new MongoObjectID(null));
        $item->setType(new ItemType($requestBody['type']));
        $item->setName($requestBody['name']);
        $item->setAvailable(true);

        return $item;

    }
}
