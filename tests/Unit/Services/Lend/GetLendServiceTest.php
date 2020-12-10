<?php

declare (strict_types = 1);

namespace Tests\Unit\Services\Lend;

use App\Services\Lend\Contracts\GetLendsServiceInterface;

final class GetLendServiceTest extends BaseLendServiceTest
{
    private $getLendService;
    public function setUp(): void
    {
        parent::setUp();
        $this->getLendService = $this->container->get(
            GetLendsServiceInterface::class
        );
    }

    public function testGetLends()
    {
        $lendsAmount = 6;
        for ($i = 0; $i < $lendsAmount; $i++) {
            $this->createLend();
        }

        $lends = $this->getLendService->execute();
        $this->assertEquals(count($lends), $lendsAmount);
    }
}
