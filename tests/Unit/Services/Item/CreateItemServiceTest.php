<?php

declare (strict_types = 1);

namespace Tests\Unit\Services\Item;

use App\Entities\ValueObjects\Contracts\UniqueIDInterface;
use App\Entities\ValueObjects\ItemType;
use App\Exceptions\ValueObjects\InvalidItemTypeReceivedException;
use App\Factories\Contracts\ItemFactory;
use App\Services\Item\Contracts\CreateItemServiceInterface;
use Tests\BaseTest;

class CreateItemServiceTest extends BaseTest
{
    private $createItemService;
    private $itemFactory;

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

    public function testCreateItem()
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

        $createdItem = $this->createItemService->execute($item);

        $this->assertInstanceOf(UniqueIDInterface::class, $createdItem->getId());
        $this->assertInstanceOf(ItemType::class, $createdItem->getType());
        $this->assertNotEmpty($createdItem->getId()->getValue());

        $this->assertEquals($itemName, $createdItem->getName());
        $this->assertEquals($itemType, $createdItem->getType()->getValue());
        $this->assertEquals($itemAvailable, $createdItem->getAvailable());
    }

    public function testCreateItemWithInvalidType()
    {
        $itemType = 'bolacha';
        $itemName = 'some-bolacha-name';
        $itemAvailable = true;

        $this->expectException(InvalidItemTypeReceivedException::class);
        $item = $this->itemFactory->fromArray(
            array(
                'name' => $itemName,
                'type' => $itemType,
                'available' => $itemAvailable,
            )
        );
    }
}