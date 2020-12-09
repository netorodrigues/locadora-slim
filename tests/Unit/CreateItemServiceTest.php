<?php

declare (strict_types = 1);

use App\Services\Item\Contracts\CreateItemServiceInterface;
use Tests\BaseTest;

class CreateItemServiceTest extends BaseTest
{
    private $createItemService;

    public function setUp(): void
    {
        parent::setUp();
        $this->createItemService = $this->container->get(
            CreateItemServiceInterface::class
        );
    }

    public function testCase()
    {
        $this->assertTrue(true);
    }
}
