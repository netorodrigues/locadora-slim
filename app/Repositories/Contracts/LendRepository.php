<?php

namespace App\Repositories\Contracts;

use App\Entities\Lend;

interface LendRepository
{
    public function get(): array;
    public function create(Lend $lend): Lend;
    public function delete(string $lendId): bool;
}
