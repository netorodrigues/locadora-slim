<?php

namespace App\Entities;

use App\Entities\Contracts\Entity;
use App\Entities\ValueObjects\Contracts\EmailInterface;
use App\Entities\ValueObjects\Contracts\UniqueIDInterface;

final class Lend implements Entity
{
    private $id;
    private $responsibleName;
    private $responsibleEmail;
    private $item;

    public function getId(): ?UniqueIDInterface
    {
        return $this->id;
    }

    public function setId(UniqueIDInterface $id)
    {
        $this->id = $id;
    }

    public function getItem(): Item
    {
        return $this->item;
    }

    public function setItem(Item $item)
    {
        $this->item = $item;
    }

    public function getResponsibleName(): string
    {
        return $this->responsibleName;
    }

    public function setResponsibleName(string $name)
    {
        $this->responsibleName = $name;
    }

    public function getResponsibleEmail(): EmailInterface
    {
        return $this->responsibleName;
    }

    public function setResponsibleEmail(EmailInterface $email)
    {
        $this->responsibleEmail = $email;
    }

    public function toArray(): array
    {
        $lendAsArray = array(
            'responsibleName' => $this->getResponsibleName(),
            'responsibleEmail' => $this->getResponsibleEmail()->getValue(),
            'item' => array(
                'id' => $this->getItem()->getId(),
                'name' => $this->getItem()->getName(),
                'name' => $this->getItem()->getType()->getValue(),
            ),
        );

        if ($this->getId()) {
            $lendAsArray['id'] = $this->getId()->getValue();
        }

        return $lendAsArray;

    }
}
