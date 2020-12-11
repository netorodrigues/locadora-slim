<?php

declare (strict_types = 1);
namespace App\Services\Lend\Contracts;

use App\Entities\Lend;

interface GetLendsServiceInterface
{
    public function execute(): array;
}
