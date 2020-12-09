<?php

declare (strict_types = 1);

namespace Tests\Unit\Services\Item;

use App\Factories\Contracts\ItemFactory;
use App\Services\Item\Contracts\CreateItemServiceInterface;
use App\Services\Item\Contracts\DeleteItemServiceInterface;
use Tests\BaseTest;

abstract class BaseItemServiceTest extends BaseTest
{
    protected $createItemService;
    protected $itemFactory;
    private $items = [];

    public function setUp(): void
    {
        parent::setUp();
        $this->createItemService = $this->container->get(
            CreateItemServiceInterface::class
        );

        $this->itemFactory = $this->container->get(
            ItemFactory::class
        );
    }

    public function tearDown(): void
    {
        parent::tearDown();

        if (empty($this->items)) {
            return;
        }

        $deleteService = $this->container->get(
            DeleteItemServiceInterface::class
        );

        foreach ($this->items as $item) {
            $itemId = $item->getId()->getValue();
            $deleteService->execute($itemId);
        }
    }

    protected function createItem()
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

        $this->items[] = $item;
        return $this->createItemService->execute($item);
    }
}
