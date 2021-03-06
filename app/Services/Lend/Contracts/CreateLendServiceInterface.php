<?php

declare (strict_types = 1);
namespace App\Services\Lend\Contracts;

use App\Entities\Lend;

interface CreateLendServiceInterface
{
    public function execute(Lend $lend): Lend;
}
