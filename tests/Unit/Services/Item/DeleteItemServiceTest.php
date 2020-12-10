<?php

declare (strict_types = 1);

namespace Tests\Unit\Services\Item;

use App\Exceptions\ItemDoesntExistsException;
use App\Exceptions\ItemUnavailableException;
use App\Repositories\Contracts\ItemRepository;
use App\Services\Item\Contracts\DeleteItemServiceInterface;

final class DeleteItemServiceTest extends BaseItemServiceTest
{
    private $deleteItemService;

    public function setUp(): void
    {
        parent::setUp();

        $this->deleteItemService = $this->container->get(
            DeleteItemServiceInterface::class
        );
    }

    public function testDeleteItem()
    {
        $item = $this->createItem();
        $itemId = $item->getId()->getValue();

        $wasDeleted = $this->deleteItemService->execute(
            $itemId
        );

        $this->assertTrue($wasDeleted);

    }

    public function testDeleteItemWithInvalidId()
    {
        $invalidId = 'some-invalid-id';

        $this->expectException(ItemDoesntExistsException::class);
        $this->deleteItemService->execute($invalidId);
    }

    public function testDeleteItemUnavailable()
    {
        $item = $this->createItem();
        $itemId = $item->getId()->getValue();

        $itemRepository = $this->container->get(
            ItemRepository::class
        );

        $itemRepository->setAsUnavailable($itemId);

        $this->expectException(ItemUnavailableException::class);
        $wasDeleted = $this->deleteItemService->execute(
            $itemId
        );
    }
}
