<?php

declare (strict_types = 1);

namespace Tests\Unit\Services\Item;

use App\Entities\ValueObjects\Contracts\UniqueIDInterface;
use App\Entities\ValueObjects\ItemType;
use App\Exceptions\ValueObjects\InvalidItemTypeReceivedException;
use App\Factories\Contracts\ItemFactory;

final class CreateItemServiceTest extends BaseItemServiceTest
{
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
