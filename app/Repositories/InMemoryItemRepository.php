<?php

declare (strict_types = 1);
namespace App\Repositories;

use App\Entities\Item;
use App\Entities\ValueObjects\MongoObjectID as ObjectID;
use App\Repositories\Contracts\ItemRepository;

final class InMemoryItemRepository implements ItemRepository
{
    private $table;

    public function __construct()
    {
        $this->table = [];
    }

    public function get(): array
    {
        return $this->table;
    }

    public function getAvailable(): array
    {
        $filteredItems = array_filter($this->table, function ($item) {
            return $item['available'] === true;
        });

        return $filteredItems;
    }

    public function setAsAvailable(string $itemId): bool
    {
        $this->update($itemId, ['available' => true]);

        return true;
    }

    public function setAsUnavailable(string $itemId): bool
    {
        $this->update($itemId, ['available' => false]);

        return true;
    }

    public function create(Item $item): Item
    {
        $objectId = new ObjectID(null);

        $entry = $item->toArray();
        $entry['id'] = $objectId->getValue();

        $this->table[] = $entry;

        $item->setId($objectId);

        return $item;
    }

    public function update(string $itemId, array $dataArray): array
    {
        $itemPosition = null;
        foreach ($this->table as $position => $item) {
            if ($itemId === $item['id']) {
                $itemPosition = $position;
                break;
            }
        }

        if ($itemPosition === null) {
            return [];
        }

        $itemArray = $this->table[$itemPosition];
        foreach ($dataArray as $key => $value) {
            $itemArray[$key] = $value;
        }

        $this->table[$itemPosition] = $itemArray;
        return $itemArray;
    }

    public function delete(string $itemId): bool
    {
        $itemPosition = array_search($itemId, array_column($this->table, 'id'));

        array_splice($this->table, $itemPosition, 1);

        return true;

    }

    public function getById(string $itemId): array
    {

        $itemArray = null;
        foreach ($this->table as $item) {
            if ($itemId === $item['id']) {
                return $item;
            }
        }

        return [];
    }
}
