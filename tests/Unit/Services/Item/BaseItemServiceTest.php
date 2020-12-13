<?php

declare (strict_types = 1);

namespace Tests\Unit\Services\Item;

use App\Factories\Contracts\ItemFactoryInterface;
use App\Repositories\Contracts\ItemRepository;
use App\Services\Item\Contracts\CreateItemServiceInterface;
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
            ItemFactoryInterface::class
        );
    }

    public function tearDown(): void
    {
        parent::tearDown();

        $itemRepository = $this->container->get(
            ItemRepository::class
        );

        $items = $itemRepository->get();

        foreach ($items as $item) {
            $itemRepository->delete($item['id']);
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
