<?php

declare (strict_types = 1);

namespace Tests\Unit\Services\Item;

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

        $wasDeleted = $this->deleteItemService->execute($invalidId);

        $this->assertTrue($wasDeleted);
    }
}
