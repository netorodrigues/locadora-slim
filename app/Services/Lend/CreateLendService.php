<?php

declare (strict_types = 1);
namespace App\Services\Lend;

use App\Entities\Lend;
use App\Entities\ValueObjects\MongoObjectID as ObjectId;
use App\Exceptions\ItemDoesntExistsException;
use App\Exceptions\ItemUnavailableException;
use App\Services\Lend\Contracts\CreateLendServiceInterface;

final class CreateLendService extends BaseLendService implements CreateLendServiceInterface
{

    private function generateLendInsertArray(Lend $lend)
    {
        return [
            'responsibleName' => $lend->getResponsibleName(),
            'responsibleEmail' => $lend->getResponsibleEmail()->getValue(),
            'itemId' => $lend->getItem()->getId()->getValue(),
        ];
    }
    public function execute(Lend $lend): Lend
    {
        $lendInsertArray = $this->generateLendInsertArray($lend);
        $itemId = $lendInsertArray['itemId'];

        $itemData = $this->itemRepository->getById($itemId);

        if (empty($itemData)) {
            throw ItemDoesntExistsException::handle($itemId);
        }

        if (!$itemData['available']) {
            throw ItemUnavailableException::handle($itemId);
        }

        $createdLendArray = $this->lendRepository->create($lendInsertArray);

        $lend->setId(new ObjectId($createdLendArray['id']));

        $this->itemRepository->setAsUnavailable($lendInsertArray['itemId']);

        return $lend;
    }
}
