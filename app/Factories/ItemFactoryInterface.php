<?php

namespace App\Factories;

use Psr\Http\Message\ServerRequestInterface as Request;

interface ItemFactoryInterface
{
    public function fromRequest(Request $request);
}
