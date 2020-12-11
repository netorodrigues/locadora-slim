<?php

declare (strict_types = 1);
namespace App\Services\Lend;

use App\Factories\Contracts\ItemFactory;
use App\Factories\Contracts\LendFactory;
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
        ItemFactory $itemFactory,
        LendFactory $lendFactory) {

        $this->lendRepository = $lendRepository;
        $this->lendFactory = $lendFactory;
        $this->itemRepository = $itemRepository;
        $this->itemFactory = $itemFactory;
    }
}
