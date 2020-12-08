<?php

namespace App\Services\Lend;

use App\Factories\Contracts\ItemFactory;
use App\Repositories\Contracts\ItemRepository;
use App\Repositories\Contracts\LendRepository;

abstract class BaseLendService
{
    protected $lendRepository;
    protected $itemRepository;
    protected $itemFactory;

    public function __construct(
        LendRepository $lendRepository,
        ItemRepository $itemRepository,
        ItemFactory $itemFactory) {

        $this->lendRepository = $lendRepository;
        $this->itemRepository = $itemRepository;
        $this->itemFactory = $itemFactory;
    }
}
