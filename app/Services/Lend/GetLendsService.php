<?php

namespace App\Services\Lend;

use App\Entities\Lend;
use App\Services\Lend\Contracts\GetLendsServiceInterface;

final class GetLendsService extends BaseLendService implements GetLendsServiceInterface
{
    public function execute(): array
    {
        return [];
    }
}
