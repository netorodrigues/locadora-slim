<?php

namespace App\Factories;

use App\Entities\Item;
use App\Entities\Lend;
use App\Entities\ValueObjects\Email;
use App\Entities\ValueObjects\MongoObjectID;
use App\Factories\Contracts\LendFactory;
use Psr\Http\Message\ServerRequestInterface as Request;

class MongoLendFactory implements LendFactory
{

    public function fromRequest(Request $request): Lend
    {
        $requestBody = $request->getParsedBody();

        $lend = new Lend;
        $lend->setResponsibleEmail(new Email($requestBody['responsibleEmail']));
        $lend->setResponsibleName($requestBody['responsibleName']);

        $item = new Item;
        $item->setId(new MongoObjectID($requestBody['itemId']));
        $lend->setItem($item);

        return $lend;

    }
}
