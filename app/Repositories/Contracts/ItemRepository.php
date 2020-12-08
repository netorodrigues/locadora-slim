<?php

namespace App\Repositories\Contracts;

use App\Entities\Item;

interface ItemRepository
{
    public function get(): array;
    public function create(Item $entity): Item;
    public function edit(string $itemId): Item;
    public function delete(string $itemId): bool;
}
