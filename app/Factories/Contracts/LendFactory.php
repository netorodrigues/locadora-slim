<?php

namespace App\Factories\Contracts;

use App\Entities\Lend;
use Psr\Http\Message\ServerRequestInterface as Request;

interface LendFactory
{
    public function fromRequest(Request $request): Lend;
    public function fromArray(array $lendData): Lend;
}
