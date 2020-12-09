<?php

declare (strict_types = 1);

namespace Tests\Unit\Services\Item;

use App\Services\Item\Contracts\GetItemsServiceInterface;

final class GetItemServiceTest extends BaseItemServiceTest
{
    private $getItemService;

    public function setUp(): void
    {
        parent::setUp();

        $this->getItemService = $this->container->get(
            GetItemsServiceInterface::class
        );
    }

    public function testGetItems()
    {
        $amountOfItemsToCreate = 5;

        for ($i = 0; $i < $amountOfItemsToCreate; $i++) {
            $this->createItem();
        }
        $items = $this->getItemService->execute();

        $this->assertEquals(count($items), $amountOfItemsToCreate);

    }
}
