<?php

declare (strict_types = 1);
namespace App\Factories\Contracts;

use App\Entities\Item;
use Psr\Http\Message\ServerRequestInterface as Request;

interface ItemFactoryInterface
{
    public function fromRequest(Request $request, array $requiredKeys): Item;
    public function fromArray(array $data): Item;
}
