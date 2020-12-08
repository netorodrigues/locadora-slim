<?php

namespace App\Services\Item\Contracts;

use App\Entities\Item;

interface GetItemsServiceInterface
{
    public function execute(): array;
}
