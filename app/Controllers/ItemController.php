<?php

declare (strict_types = 1);
namespace App\Controllers;

use App\Exceptions\ItemDoesntExistsException;
use App\Exceptions\ItemUnavailableException;
use App\Exceptions\ValueObjects\InvalidItemTypeReceivedException;
use App\Factories\Contracts\ItemFactoryInterface;
use App\Services\Item\Contracts\CreateItemServiceInterface;
use App\Services\Item\Contracts\DeleteItemServiceInterface;
use App\Services\Item\Contracts\EditItemServiceInterface;
use App\Services\Item\Contracts\GetItemsServiceInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Throwable;

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
        ItemFactoryInterface $factory
    ) {
        $this->itemFactory = $factory;

        $this->createItemService = $createItemService;
        $this->getItemService = $getItemService;
        $this->editItemService = $editItemService;
        $this->deleteItemService = $deleteItemService;
    }

    public function get(Request $request, Response $response): Response
    {
        try {

            $items = $this->getItemService->execute();

            return $this->responseOk($response, $items);
        } catch (Throwable $e) {
            return $this->responseInternalServerError($response, [$e->getMessage()]);
        }
    }

    public function post(Request $request, Response $response): Response
    {

        try {

            $baseItem = $this->itemFactory->fromRequest($request);
            $createdItem = $this->createItemService->execute($baseItem);

            return $this->responseCreated($response, $createdItem->toArray());
        } catch (InvalidItemTypeReceivedException $e) {
            return $this->responseBadRequest($response, [$e->getMessage()]);
        } catch (Throwable $e) {
            return $this->responseInternalServerError($response, [$e->getMessage()]);
        }
    }

    public function put(string $id, Request $request, Response $response): Response
    {

        try {

            $item = $this->editItemService->execute($id, $request->getParsedBody());

            return $this->responseOk($response, $item->toArray());
        } catch (ItemDoesntExistsException $e) {
            return $this->responseNotAcceptable($response, [$e->getMessage()]);
        } catch (InvalidItemTypeReceivedException $e) {
            return $this->responseBadRequest($response, [$e->getMessage()]);
        } catch (Throwable $e) {
            return $this->responseInternalServerError($response, [$e->getMessage()]);
        }
    }

    public function delete(string $id, Request $request, Response $response): Response
    {
        try {
            $wasDeleted = $this->deleteItemService->execute($id);

            return $this->responseOk($response, ['deleted' => $wasDeleted]);
        } catch (ItemDoesntExistsException $e) {
            return $this->responseNotAcceptable($response, [$e->getMessage()]);
        } catch (ItemUnavailableException $e) {
            return $this->responseForbidden($response, [$e->getMessage()]);
        } catch (Throwable $e) {
            return $this->responseInternalServerError($response, [$e->getMessage()]);
        }
    }
}
