<?php

namespace App\Services\Item;

use App\Entities\Item;
use App\Services\Item\Contracts\DeleteItemServiceInterface;

final class DeleteItemService extends BaseItemService implements DeleteItemServiceInterface
{
    public function execute(string $itemId): bool
    {
        return $this->itemRepository->delete($itemId);
    }
}
