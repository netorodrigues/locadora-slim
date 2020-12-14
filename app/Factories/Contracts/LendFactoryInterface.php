<?php

declare (strict_types = 1);
namespace App\Factories\Contracts;

use App\Entities\Lend;
use Psr\Http\Message\ServerRequestInterface as Request;

interface LendFactoryInterface
{
    public function fromRequest(Request $request, array $requiredKeys): Lend;
    public function fromArray(array $lendData): Lend;
}
