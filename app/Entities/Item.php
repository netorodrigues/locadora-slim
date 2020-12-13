<?php

declare (strict_types = 1);
namespace App\Entities;

use App\Entities\Contracts\Entity;
use App\Entities\ValueObjects\Contracts\UniqueIDInterface;
use App\Entities\ValueObjects\ItemType;

final class Item implements Entity
{
    public static $editableColumns = ['type', 'name'];
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

    public function getType(): ?ItemType
    {
        return $this->type;
    }

    public function setType(ItemType $type)
    {
        $this->type = $type;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getAvailable(): ?bool
    {
        return $this->available;
    }

    public function setAvailable(bool $available)
    {
        $this->available = $available;
    }

    public function toArray(): array
    {
        $itemAsArray = array();

        if ($this->getType()) {
            $itemAsArray['type'] = $this->getType()->getValue();
        }

        if ($this->getName()) {
            $itemAsArray['name'] = $this->getName();
        }

        if ($this->getAvailable()) {
            $itemAsArray['available'] = $this->getAvailable();
        }

        if ($this->getId()) {
            $itemAsArray['id'] = $this->getId()->getValue();
        }

        return $itemAsArray;

    }
}
