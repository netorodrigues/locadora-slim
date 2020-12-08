<?php

namespace App\Controllers;

use App\Factories\Contracts\ItemFactory;
use App\Services\Item\Contracts\CreateItemServiceInterface;
use App\Services\Item\Contracts\DeleteItemServiceInterface;
use App\Services\Item\Contracts\EditItemServiceInterface;
use App\Services\Item\Contracts\GetItemsServiceInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class ItemController extends JSONController
{

    private $itemFactory;
    private $createItemService;
    private $getItemService;
    private $deleteItemService;

    public function __construct(
        CreateItemServiceInterface $createItemService,
        GetItemsServiceInterface $getItemService,
        EditItemServiceInterface $editItemService,
        DeleteItemServiceInterface $deleteItemService,
        ItemFactory $factory
    ) {
        $this->itemFactory = $factory;

        $this->createItemService = $createItemService;
        $this->getItemService = $getItemService;
        $this->editItemService = $editItemService;
        $this->deleteItemService = $deleteItemService;
    }

    public function get(Request $request, Response $response): Response
    {
        $items = $this->getItemService->execute();
        return $this->sendJson($response, $items, 200);
    }

    public function post(Request $request, Response $response): Response
    {
        $baseItem = $this->itemFactory->fromRequest($request);
        $createdItem = $this->createItemService->execute($baseItem);
        return $this->sendJson($response, $createdItem->toArray(), 200);
    }

    public function put(string $itemId, Request $request, Response $response): Response
    {
        $item = $this->editItemService->execute($itemId, $request->getParsedBody());
        return $this->sendJson($response, $item->toArray(), 200);
    }

    public function delete(string $itemId, Request $request, Response $response): Response
    {
        $wasDeleted = $this->deleteItemService->execute($itemId);
        return $this->sendJson($response, ['deleted' => $wasDeleted], 200);
    }
}
