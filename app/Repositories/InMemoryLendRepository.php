<?php

namespace App\Repositories;

use App\Entities\ValueObjects\MongoObjectID as ObjectId;
use App\Repositories\Contracts\LendRepository;

final class InMemoryLendRepository implements LendRepository
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

    public function getById(string $lendId): array
    {
        foreach ($this->table as $lend) {
            if ($lendId === $lend['id']) {
                return $lend;
            }
        }

        return [];
    }

    public function create(array $lend): array
    {
        $objectId = new ObjectId(null);

        $lend['id'] = $objectId->getValue();

        $this->table[] = $lend;
        return $lend;
    }

    public function delete(string $lendId): bool
    {
        $lendPosition = array_search($lendId, array_column($this->table, 'id'));

        array_splice($this->table, $lendPosition, 1);

        return true;
    }
}
