<?php

namespace App\Controllers;

use App\Factories\ItemFactoryInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class ItemController
{

    private $itemFactory;

    public function __construct(ItemFactoryInterface $factory)
    {
        $this->itemFactory = $factory;
    }

    public function get(Request $request, Response $response)
    {
        $response->getBody()->write("Hello world!");
        return $response;
    }

    public function post(Request $request, Response $response)
    {
        $item = $this->itemFactory->fromRequest($request);
        $response->getBody()->write($item);
        return $response;
    }
}
