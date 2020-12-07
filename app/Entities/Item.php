<?php

namespace App\Entities;

use App\Entities\Contracts\EntityInterface;
use App\Entities\ValueObjects\Contracts\UniqueIDInterface;
use App\Entities\ValueObjects\ItemType;

final class Item implements EntityInterface
{
    private $id;
    private $type;
    private $name;
    private $available;

    public function getId(): ?UniqueIDInterface
    {
        return $this->id;
    }

    public function setId(UniqueIDInterface $id)
    {
        $this->id = $id;
    }

    public function getType(): ItemType
    {
        return $this->type;
    }

    public function setType(ItemType $type)
    {
        $this->type = $type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getAvailable(): bool
    {
        return $this->available;
    }

    public function setAvailable(bool $available)
    {
        $this->available = $available;
    }

    public function toArray(): array
    {
        $itemAsArray = array(
            'type' => $this->getType()->getValue(),
            'name' => $this->getName(),
            'available' => $this->getAvailable(),
        );

        if ($this->getId()) {
            $itemAsArray['id'] = $this->getId()->getValue();
        }

        return $itemAsArray;

    }
}
