<?php

namespace App\Services\Lend;

use App\Entities\Lend;
use App\Services\Lend\Contracts\DeleteLendServiceInterface;

final class DeleteLendService extends BaseLendService implements DeleteLendServiceInterface
{
    public function execute(string $lendId): bool
    {
        $lend = $this->lendRepository->getById($lendId);

        $wasSetAvailable = $this->itemRepository
            ->setAsAvailable($lend['itemId']);

        return $this->lendRepository->delete($lendId);
    }
}
