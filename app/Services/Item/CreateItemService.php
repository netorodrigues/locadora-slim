<?php

namespace App\Services\Item;

use App\Entities\Item;
use App\Repositories\Contracts\ItemRepository;
use App\Services\Item\Contracts\CreateItemServiceInterface;

final class CreateItemService implements CreateItemServiceInterface
{
    private $itemRepository;
    public function __construct(ItemRepository $repository)
    {
        $this->itemRepository = $repository;
    }
    public function execute(Item $item): Item
    {
        $createdItem = $this->itemRepository->create($item);
        return $createdItem;
    }
}
