<?php

declare (strict_types = 1);

namespace Tests\Unit\Services\Item;

use App\Factories\Contracts\ItemFactory;
use App\Services\Item\Contracts\CreateItemServiceInterface;
use App\Services\Item\Contracts\DeleteItemServiceInterface;
use Tests\BaseTest;

class DeleteItemServiceTest extends BaseTest
{
    private $deleteItemService;
    private $createItemService;
    private $itemFactory;

    public function setUp(): void
    {
        parent::setUp();

        $this->createItemService = $this->container->get(
            CreateItemServiceInterface::class
        );

        $this->deleteItemService = $this->container->get(
            DeleteItemServiceInterface::class
        );

        $this->itemFactory = $this->container->get(
            ItemFactory::class
        );
    }

    private function createItem()
    {
        $itemType = 'book';
        $itemName = 'some-book-name';
        $itemAvailable = true;

        $item = $this->itemFactory->fromArray(
            array(
                'name' => $itemName,
                'type' => $itemType,
                'available' => $itemAvailable,
            )
        );

        return $this->createItemService->execute($item);
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

        $wasDeleted = $this->deleteItemService->execute($invalidId);

        $this->assertTrue($wasDeleted);
    }
}
