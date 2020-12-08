<?php

namespace App\Services\Item\Contracts;

interface DeleteItemServiceInterface
{
    public function execute(string $itemId): bool;
}
