<?php

declare (strict_types = 1);

namespace Tests\Unit\Services\Lend;

use App\Services\Lend\Contracts\DeleteLendServiceInterface;

final class DeleteServiceLendTest extends BaseLendServiceTest
{
    private $deleteLendService;
    public function setUp(): void
    {
        parent::setUp();
        $this->deleteLendService = $this->container->get(
            DeleteLendServiceInterface::class
        );
    }

    public function testeDeleteLend()
    {
        $lend = $this->createLend();

        $wasDeleted = $this->deleteLendService->execute($lend->getId()->getValue());
        $this->assertTrue($wasDeleted);
    }

}
