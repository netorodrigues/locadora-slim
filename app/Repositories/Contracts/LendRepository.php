<?php

declare (strict_types = 1);
namespace App\Repositories\Contracts;

interface LendRepository
{
    public function get(): array;
    public function getById(string $lendId): array;
    public function create(array $lend): array;
    public function delete(string $lendId): bool;
}
