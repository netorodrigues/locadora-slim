<?php

declare (strict_types = 1);
namespace App\Repositories\Contracts;

use App\Entities\Item;

interface ItemRepository
{
    public function get(): array;
    public function getAvailable(): array;
    public function setAsAvailable(string $itemId): bool;
    public function setAsUnavailable(string $itemId): bool;
    public function create(Item $entity): Item;
    public function getById(string $itemId): array;
    public function update(string $itemId, array $data): array;
    public function delete(string $itemId): bool;
}
