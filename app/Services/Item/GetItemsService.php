<?php

namespace App\Services\Item;

use App\Entities\Item;
use App\Services\Item\Contracts\GetItemsServiceInterface;

final class GetItemsService extends BaseItemService implements GetItemsServiceInterface
{
    public function execute(): array
    {
        $rows = $this->itemRepository->getAvailable();

        foreach ($rows as &$row) {
            $row->id = $row->_id;
            unset($row->_id);
        }

        return $rows;
    }
}
