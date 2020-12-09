<?php

declare (strict_types = 1);

use App\Entities\ValueObjects\Contracts\UniqueIDInterface;
use App\Entities\ValueObjects\ItemType;
use App\Exceptions\ItemDoesntExistsException;
use App\Factories\Contracts\ItemFactory;
use App\Services\Item\Contracts\CreateItemServiceInterface;
use App\Services\Item\Contracts\EditItemServiceInterface;
use Tests\BaseTest;

class EditItemServiceTest extends BaseTest
{
    private $editItemService;
    private $createItemService;
    private $itemFactory;

    public function setUp(): void
    {
        parent::setUp();

        $this->createItemService = $this->container->get(
            CreateItemServiceInterface::class
        );

        $this->editItemService = $this->container->get(
            EditItemServiceInterface::class
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
