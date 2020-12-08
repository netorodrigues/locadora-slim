<?php

namespace App\Repositories\MongoDB;

use App\Entities\Lend;
use App\Repositories\Contracts\LendRepository;
use \MongoDB\Driver\Manager as MongoDBManager;
use \MongoDB\Driver\Query as MongoDBQuery;

final class MongoLendRepository implements LendRepository
{
    private $mongoManager;

    private $databaseName;
    private $collectionName;
    private $collectionIdentifier;

    public function __construct(MongoDBManager $manager)
    {
        $this->databaseName = $_SERVER["DB_NAME"];
        $this->collectionName = 'lend';
        $this->collectionIdentifier = $this->databaseName . '.' . $this->collectionName;

        $this->mongoManager = $manager;
    }

    public function get(): array
    {
        $query = new MongoDBQuery([]);

        $rows = $this->mongoManager->executeQuery($this->collectionIdentifier, $query);

        return $rows->toArray();
    }

    public function create(Lend $lend): Lend
    {
        return $lend;
    }

    public function delete(string $lendId): bool
    {
        return false;
    }
}
