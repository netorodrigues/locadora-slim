<?php

declare (strict_types = 1);
namespace App\Services\Item;

use App\Entities\Item;
use App\Factories\Contracts\ItemFactoryInterface;
use App\Repositories\Contracts\ItemRepository;

abstract class BaseItemService
{
    protected $itemRepository;
    protected $itemFactory;
    public function __construct(ItemRepository $repository, ItemFactoryInterface $factory)
    {
        $this->itemRepository = $repository;
        $this->itemFactory = $factory;
    }
}
