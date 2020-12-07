<?php

namespace App\Entities;

use App\Entities\ValueObjects\ItemType;
use App\Entities\ValueObjects\Uuid;

final class Item implements EntityInterface
{
    private $uuid;
    private $type;
    private $name;
    private $available;

    public function getUuid(): Uuid
    {
        return $this->uuid;
    }

    public function setUuid(Uuid $uuid)
    {
        $this->uuid = $uuid;
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

    private function setAvailable(bool $available)
    {
        $this->available = $available;
    }

    public function toArray(): array
    {
        return array(
            'id' => $this->uuid->getValue(),
            'type' => $this->type->getValue(),
            'name' => $this->getName(),
            'available' => $this->getAvailable(),
        );
    }
}
