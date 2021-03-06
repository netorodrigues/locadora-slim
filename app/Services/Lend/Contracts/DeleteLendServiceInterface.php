<?php

declare (strict_types = 1);
namespace App\Services\Lend\Contracts;

use App\Entities\Lend;

interface DeleteLendServiceInterface
{
    public function execute(string $lendId): bool;
}
