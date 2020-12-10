<?php

declare (strict_types = 1);

namespace Tests\Unit\Services\Lend;

use App\Factories\Contracts\ItemFactory;
use App\Factories\Contracts\LendFactory;
use App\Services\Item\Contracts\CreateItemServiceInterface;
use App\Services\Item\Contracts\DeleteItemServiceInterface;
use App\Services\Lend\Contracts\CreateLendServiceInterface;
use App\Services\Lend\Contracts\DeleteLendServiceInterface;
use Tests\BaseTest;

abstract class BaseLendServiceTest extends BaseTest
{
    protected $createItemService;
    protected $createLendService;
    protected $itemFactory;
    protected $lendFactory;
    private $items = [];
    private $lends = [];

    public function setUp(): void
    {
        parent::setUp();
        $this->createItemService = $this->container->get(
            CreateItemServiceInterface::class
        );

        $this->createLendService = $this->container->get(
            CreateLendServiceInterface::class
        );

        $this->itemFactory = $this->container->get(
            ItemFactory::class
        );

        $this->lendFactory = $this->container->get(
            LendFactory::class
        );
    }

    public function tearDown(): void
    {
        parent::tearDown();

        $this->clearLends();
        $this->clearItems();

    }

    private function clearItems()
    {
        $deleteItemService = $this->container->get(
            DeleteItemServiceInterface::class
        );

        foreach ($this->items as $item) {
            $itemId = $item->getId()->getValue();
            $deleteItemService->execute($itemId);
        }

        $this->items = [];
    }

    private function clearLends()
    {
        $deleteLendService = $this->container->get(
            DeleteLendServiceInterface::class
        );
        foreach ($this->lends as $lend) {
            $lendId = $lend->getId()->getValue();
            $deleteLendService->execute($lendId);
        }

        $this->lends = [];
    }

    protected function markToRemove($lend)
    {
        $this->lends[] = $lend;
        $this->items[] = $lend->getItem();
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

    protected function createLend()
    {
        $lendName = 'some-guy';
        $lendEmail = 'some-email@gmail.com';

        $item = $this->createItem();
        $itemId = $item->getId()->getValue();

        $lend = $this->lendFactory->fromArray(
            array(
                'responsibleName' => $lendName,
                'responsibleEmail' => $lendEmail,
                'itemId' => $itemId,
            )
        );

        $this->lends[] = $lend;
        return $this->createLendService->execute($lend);

    }
}
