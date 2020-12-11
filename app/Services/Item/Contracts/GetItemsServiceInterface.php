<?php

declare (strict_types = 1);
namespace App\Services\Item\Contracts;

use App\Entities\Item;

interface GetItemsServiceInterface
{
    public function execute(): array;
}
