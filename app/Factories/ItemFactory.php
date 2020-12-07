<?php

namespace App\Factories;

use Psr\Http\Message\ServerRequestInterface as Request;

class ItemFactory implements ItemFactoryInterface
{
    public function fromRequest(Request $request)
    {
        return "factory called! :)";
    }
}
