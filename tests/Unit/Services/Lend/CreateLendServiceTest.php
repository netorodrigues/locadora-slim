<?php

declare (strict_types = 1);

namespace Tests\Unit\Services\Lend;

use App\Entities\ValueObjects\Contracts\EmailInterface;
use App\Entities\ValueObjects\Contracts\UniqueIDInterface;
use App\Exceptions\ItemDoesntExistsException;

final class CreateLendServiceTest extends BaseLendServiceTest
{
    public function testCreateLend()
    {
        $lendName = 'New Lend Responsible';
        $lendEmail = 'new.lend.guy@hotmail.com';
        $item = $this->createItem();
        $itemId = $item->getId()->getValue();

        $lend = $this->lendFactory->fromArray(
            array(
                'responsibleName' => $lendName,
                'responsibleEmail' => $lendEmail,
                'itemId' => $itemId,
            )
        );

        $createdLend = $this->createLendService->execute($lend);

        $this->assertInstanceOf(UniqueIDInterface::class, $createdLend->getId());
        $this->assertInstanceOf(EmailInterface::class, $createdLend->getResponsibleEmail());
        $this->assertNotEmpty($createdLend->getId()->getValue());

        $this->assertEquals($lendName, $createdLend->getResponsibleName());
        $this->assertEquals($lendEmail, $createdLend->getResponsibleEmail()->getValue());
        $this->assertEquals(
            $itemId,
            $createdLend->getItem()->getId()->getValue()
        );
    }

    public function testCreateLendWithInvalidItem()
    {
        $lendName = 'New Lend Responsible';
        $lendEmail = 'new.lend.guy@hotmail.com';
        $itemId = 'some-invalid-id';

        $this->expectException(ItemDoesntExistsException::class);
        $lend = $this->lendFactory->fromArray(
            array(
                'responsibleName' => $lendName,
                'responsibleEmail' => $lendEmail,
                'itemId' => $itemId,
            )
        );

    }

}
