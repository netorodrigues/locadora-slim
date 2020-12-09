<?php

namespace App\Factories;

use App\Entities\Lend;
use App\Entities\ValueObjects\Email;
use App\Factories\Contracts\ItemFactory;
use App\Factories\Contracts\LendFactory;
use App\Repositories\Contracts\ItemRepository;
use Psr\Http\Message\ServerRequestInterface as Request;

class MongoLendFactory implements LendFactory
{

    private $itemFactory;
    private $itemRepository;
    public function __construct(ItemFactory $itemFactory, ItemRepository $itemRepository)
    {
        $this->itemFactory = $itemFactory;
        $this->itemRepository = $itemRepository;
    }

    public function fromRequest(Request $request): Lend
    {
        $requestBody = $request->getParsedBody();

        $lend = new Lend;
        $lend->setResponsibleEmail(new Email($requestBody['responsibleEmail']));
        $lend->setResponsibleName($requestBody['responsibleName']);

        $itemData = $this->itemRepository->getById(
            $requestBody['itemId']
        );

        $item = $this->itemFactory->fromArray($itemData);
        $lend->setItem($item);

        return $lend;

    }

    public function fromArray(array $lendData): Lend
    {
        $lend = new Lend;
        $lend->setResponsibleEmail(new Email($lendData['responsibleEmail']));
        $lend->setResponsibleName($lendData['responsibleName']);

        $itemData = $this->itemRepository->getById(
            $lendData['itemId']
        );

        $item = $this->itemFactory->fromArray($itemData);
        $lend->setItem($item);

        return $lend;

    }
}
