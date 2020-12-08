<?php

namespace App\Services\Item\Contracts;

use App\Entities\Item;

interface CreateItemServiceInterface
{
    public function execute(Item $item): Item;
}
