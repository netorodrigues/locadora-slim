<?php

declare (strict_types = 1);
namespace App\Services\Item\Contracts;

use App\Entities\Item;

interface CreateItemServiceInterface
{
    public function execute(Item $item): Item;
}
