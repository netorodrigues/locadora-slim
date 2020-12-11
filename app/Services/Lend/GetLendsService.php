<?php

declare (strict_types = 1);
namespace App\Services\Lend;

use App\Entities\Lend;
use App\Services\Lend\Contracts\GetLendsServiceInterface;

final class GetLendsService extends BaseLendService implements GetLendsServiceInterface
{
    public function execute(): array
    {
        $lends = [];
        $lendRows = $this->lendRepository->get();

        foreach ($lendRows as $lendRow) {
            $lend = $this->lendFactory->fromArray((array) $lendRow);
            $lends[] = $lend->toArray();
        }

        return $lends;
    }
}
