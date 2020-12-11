<?php

declare (strict_types = 1);
namespace App\Services\Item;

use App\Entities\Item;
use App\Exceptions\ItemDoesntExistsException;
use App\Exceptions\ItemUnavailableException;
use App\Services\Item\Contracts\DeleteItemServiceInterface;

final class DeleteItemService extends BaseItemService implements DeleteItemServiceInterface
{
    public function execute(string $itemId): bool
    {
        $item = $this->itemRepository->getById($itemId);

        if (empty($item)) {
            throw ItemDoesntExistsException::handle($itemId);
        }

        if (!$item['available']) {
            throw ItemUnavailableException::handle($item['id']);
        }

        return $this->itemRepository->delete($itemId);
    }
}
