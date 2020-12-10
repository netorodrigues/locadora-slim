<?php

declare (strict_types = 1);

namespace Tests\Unit\Services\Lend;

use App\Entities\ValueObjects\Contracts\EmailInterface;
use App\Entities\ValueObjects\Contracts\UniqueIDInterface;
use App\Exceptions\ItemDoesntExistsException;
use App\Exceptions\ItemUnavailableException;
use App\Exceptions\ValueObjects\InvalidEmailReceivedException;

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

        $this->markToRemove($createdLend);
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

    public function testCreateLendWithInvalidEmail()
    {
        $lendName = 'New Lend Responsible';
        $lendEmail = 'some-invalid-email';
        $item = $this->createItem();
        $itemId = $item->getId()->getValue();

        $this->expectException(InvalidEmailReceivedException::class);
        $lend = $this->lendFactory->fromArray(
            array(
                'responsibleName' => $lendName,
                'responsibleEmail' => $lendEmail,
                'itemId' => $itemId,
            )
        );

    }

    public function testCreateLendForUnavailableItem()
    {
        $lend = $this->createLend();

        $responsibleName = 'some-other-guy';
        $responsibleEmail = 'other.guy@email.com';
        $itemId = $lend->getItem()->getId()->getValue();

        $newLend = $this->lendFactory->fromArray(
            array(
                'responsibleName' => $responsibleName,
                'responsibleEmail' => $responsibleEmail,
                'itemId' => $itemId,
            )
        );

        $this->expectException(ItemUnavailableException::class);
        $this->createLendService->execute($newLend);

    }

}
