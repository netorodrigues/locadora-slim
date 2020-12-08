<?php

namespace App\Services\Lend\Contracts;

use App\Entities\Lend;

interface GetLendsServiceInterface
{
    public function execute(): array;
}
