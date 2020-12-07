<?php

namespace App\Factories\Contracts;

use Psr\Http\Message\ServerRequestInterface as Request;

interface ItemFactoryInterface
{
    public function fromRequest(Request $request);
}
