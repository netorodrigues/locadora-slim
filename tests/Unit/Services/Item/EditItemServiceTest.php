<?php

declare (strict_types = 1);

namespace Tests\Unit\Services\Item;

use App\Entities\ValueObjects\Contracts\UniqueIDInterface;
use App\Entities\ValueObjects\ItemType;
use App\Exceptions\ItemDoesntExistsException;
use App\Services\Item\Contracts\EditItemServiceInterface;

final class EditItemServiceTest extends BaseItemServiceTest
{
    private $editItemService;

    public function setUp(): void
    {
        parent::setUp();

        $this->editItemService = $this->container->get(
            EditItemServiceInterface::class
        );
    }

    public function testEditItem()
    {
        $otherBookName = 'another-book-name';
        $item = $this->createItem();
        $itemId = $item->getId()->getValue();

        $editedItem = $this->editItemService->execute(
            $itemId,
            ['name' => $otherBookName]
        );
        $this->assertInstanceOf(UniqueIDInterface::class, $editedItem->getId());
        $this->assertInstanceOf(ItemType::class, $editedItem->getType());
        $this->assertNotEmpty($editedItem->getId()->getValue());

        $this->assertEquals($otherBookName, $editedItem->getName());

    }

    public function testEditWithInvalidId()
    {
        $invalidId = 'some-invalid-id';

        $this->expectException(ItemDoesntExistsException::class);
        $this->editItemService->execute(
            $invalidId, ['name' => 'must-throw-exception']
        );

    }
}
