<?php

namespace App\Services\Lend;

use App\Entities\Lend;
use App\Entities\ValueObjects\MongoObjectID as ObjectId;
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

        $createdLendArray = $this->lendRepository->create($lendInsertArray);

        $lend->setId(new ObjectId($createdLendArray['id']));

        return $lend;
    }
}
