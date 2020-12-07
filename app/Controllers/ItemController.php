<?php

namespace App\Controllers;

use App\Factories\Contracts\ItemFactoryInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class ItemController extends JSONController
{

    private $itemFactory;

    public function __construct(ItemFactoryInterface $factory)
    {
        $this->itemFactory = $factory;
    }

    public function get(Request $request, Response $response): Response
    {
        $response->getBody()->write("Hello world!");
        return $response;
    }

    public function post(Request $request, Response $response): Response
    {
        $item = $this->itemFactory->fromRequest($request);
        return $this->sendJson($response, $item->toArray(), 200);
    }
}
