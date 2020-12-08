<?php

namespace App\Controllers;

use App\Factories\Contracts\ItemFactory;
use App\Services\Item\Contracts\CreateItemServiceInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class ItemController extends JSONController
{

    private $itemFactory;
    private $createItemService;

    public function __construct(
        CreateItemServiceInterface $createItemService,
        ItemFactory $factory
    ) {
        $this->itemFactory = $factory;
        $this->createItemService = $createItemService;
    }

    public function get(Request $request, Response $response): Response
    {
        $response->getBody()->write("Hello world!");
        return $response;
    }

    public function post(Request $request, Response $response): Response
    {
        $baseItem = $this->itemFactory->fromRequest($request);
        $createdItem = $this->createItemService->execute($baseItem);
        return $this->sendJson($response, $createdItem->toArray(), 200);
    }
}
