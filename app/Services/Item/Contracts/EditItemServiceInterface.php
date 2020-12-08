<?php

namespace App\Services\Item\Contracts;

use App\Entities\Item;

interface EditItemServiceInterface
{
    public function execute(string $itemId, array $updatedItemData): Item;
}
