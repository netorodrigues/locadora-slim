<?php

declare (strict_types = 1);
namespace App\Services\Item\Contracts;

interface DeleteItemServiceInterface
{
    public function execute(string $itemId): bool;
}
