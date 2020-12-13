<?php

declare (strict_types = 1);
namespace App\Factories;

use App\Entities\Lend;
use App\Entities\ValueObjects\Email;
use App\Entities\ValueObjects\MongoObjectID as ObjectId;
use App\Exceptions\ItemDoesntExistsException;
use App\Factories\Contracts\ItemFactoryInterface;
use App\Factories\Contracts\LendFactoryInterface;
use App\Repositories\Contracts\ItemRepository;
use Psr\Http\Message\ServerRequestInterface as Request;

final class LendFactory implements LendFactoryInterface
{

    private $itemFactory;
    private $itemRepository;
    public function __construct(ItemFactoryInterface $itemFactory, ItemRepository $itemRepository)
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

        if (empty($itemData)) {
            throw ItemDoesntExistsException::handle($requestBody['itemId']);
        }

        $item = $this->itemFactory->fromArray($itemData);
        $lend->setItem($item);

        return $lend;

    }

    public function fromArray(array $lendData): Lend
    {
        $lend = new Lend;

        if (array_key_exists('responsibleEmail', $lendData)) {
            $lend->setResponsibleEmail(new Email($lendData['responsibleEmail']));
        }

        if (array_key_exists('responsibleName', $lendData)) {
            $lend->setResponsibleName($lendData['responsibleName']);
        }

        if (array_key_exists('id', $lendData)) {
            $lend->setId(new ObjectId($lendData['id']));
        }

        $itemData = $this->itemRepository->getById(
            $lendData['itemId']
        );

        if (empty($itemData)) {
            throw ItemDoesntExistsException::handle($lendData['itemId']);
        }
        $item = $this->itemFactory->fromArray($itemData);
        $lend->setItem($item);

        return $lend;

    }
}
