<?php

declare (strict_types = 1);

namespace Tests\Unit\Services\Lend;

use App\Factories\Contracts\ItemFactoryInterface;
use App\Factories\Contracts\LendFactory;
use App\Repositories\Contracts\ItemRepository;
use App\Repositories\Contracts\LendRepository;
use App\Services\Item\Contracts\CreateItemServiceInterface;
use App\Services\Lend\Contracts\CreateLendServiceInterface;
use Tests\BaseTest;

abstract class BaseLendServiceTest extends BaseTest
{
    protected $createItemService;
    protected $createLendService;
    protected $itemFactory;
    protected $lendFactory;

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
            ItemFactoryInterface::class
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

        $itemRepository = $this->container->get(
            ItemRepository::class
        );

        $items = $itemRepository->get();

        foreach ($items as $item) {
            $itemRepository->delete($item['id']);
        }

    }

    private function clearLends()
    {
        $lendRepository = $this->container->get(
            LendRepository::class
        );

        $lends = $lendRepository->get();
        foreach ($lends as $lend) {
            $lendRepository->delete($lend['id']);
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

        return $this->createLendService->execute($lend);

    }
}
