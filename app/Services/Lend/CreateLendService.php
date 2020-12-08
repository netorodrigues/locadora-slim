<?php

namespace App\Services\Lend;

use App\Entities\Lend;
use App\Services\Lend\Contracts\CreateLendServiceInterface;

final class CreateLendService extends BaseLendService implements CreateLendServiceInterface
{
    public function execute(Lend $lend): Lend
    {
        $createdLend = $this->lendRepository->create($lend);
        return $createdLend;
    }
}
