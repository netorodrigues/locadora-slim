<?php

declare (strict_types = 1);
namespace App\Services\Item;

use App\Entities\Item;
use App\Exceptions\ItemDoesntExistsException;
use App\Services\Item\Contracts\EditItemServiceInterface;

final class EditItemService extends BaseItemService implements EditItemServiceInterface
{

    private function generateUpdateArray(array $updatedItemData): array
    {
        $columnsArray = [];
        foreach ($updatedItemData as $key => $value) {
            if (in_array($key, Item::$editableColumns)) {
                $columnsArray[$key] = $value;
            }
        }

        return $columnsArray;
    }
    public function execute(string $itemId, array $updatedItemData): Item
    {
        $existingItem = $this->itemRepository->getById($itemId);

        if (empty($existingItem)) {
            throw ItemDoesntExistsException::handle($itemId);
        }
        $columnsArray = $this->generateUpdateArray($updatedItemData);

        $itemArrayData = $this->itemRepository->update($itemId, $columnsArray);

        return $this->itemFactory->fromArray($itemArrayData);
    }
}
