<?php

declare (strict_types = 1);
namespace App\Repositories\MongoDB;

use App\Entities\ValueObjects\MongoObjectID as ObjectId;
use App\Repositories\Contracts\LendRepository;
use \MongoDB\Driver\BulkWrite as MongoDBBulkWrite;
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

        $rowsArray = $rows->toArray();

        foreach ($rowsArray as &$row) {
            $row->id = $row->_id;
            unset($row->_id);
        }

        return $rowsArray;
    }

    public function getById(string $lendId): array
    {
        $filter = ['_id' => $lendId];
        $query = new MongoDBQuery($filter);

        $lendData = $this->mongoManager->executeQuery($this->collectionIdentifier, $query);
        $lendArray = (array) current($lendData->toArray());

        $lendArray['id'] = $lendArray['_id'];
        return $lendArray;
    }

    public function create(array $lend): array
    {
        $bulk = new MongoDBBulkWrite;
        $objectId = new ObjectId(null);

        $lend['_id'] = $objectId->getValue();

        $bulk->insert($lend);

        $this->mongoManager->executeBulkWrite($this->collectionIdentifier, $bulk);

        $lend['id'] = $lend['_id'];
        unset($lend['_id']);
        return $lend;
    }

    public function delete(string $lendId): bool
    {
        $bulk = new MongoDBBulkWrite;

        $bulk->delete(['_id' => $lendId]);

        $bulkWriteResult = $this->mongoManager->executeBulkWrite($this->collectionIdentifier, $bulk);

        return !empty($bulkWriteResult->getDeletedCount());
    }
}
