<?php

namespace App\Services\Item;

use App\Entities\Item;
use App\Repositories\Contracts\ItemRepository;

abstract class BaseItemService
{
    protected $itemRepository;
    public function __construct(ItemRepository $repository)
    {
        $this->itemRepository = $repository;
    }
}
