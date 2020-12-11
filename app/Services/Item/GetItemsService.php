<?php

declare (strict_types = 1);
namespace App\Services\Item;

use App\Entities\Item;
use App\Services\Item\Contracts\GetItemsServiceInterface;

final class GetItemsService extends BaseItemService implements GetItemsServiceInterface
{
    public function execute(): array
    {
        $rows = $this->itemRepository->getAvailable();

        return $rows;
    }
}
