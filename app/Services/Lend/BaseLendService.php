<?php

namespace App\Services\Lend;

use App\Repositories\Contracts\LendRepository;

abstract class BaseLendService
{
    protected $lendRepository;
    public function __construct(LendRepository $repository)
    {
        $this->lendRepository = $repository;
    }
}
