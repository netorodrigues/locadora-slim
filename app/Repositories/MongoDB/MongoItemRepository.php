<?php

namespace App\Repositories\MongoDB;

use App\Entities\Item;
use App\Entities\ValueObjects\MongoObjectID as ObjectId;
use App\Repositories\Contracts\ItemRepository;
use \MongoDB\Driver\BulkWrite as MongoDBBulkWrite;
use \MongoDB\Driver\Manager as MongoDBManager;
use \MongoDB\Driver\Query as MongoDBQuery;

final class MongoItemRepository implements ItemRepository
{
    private $mongoManager;

    private $databaseName;
    private $collectionName;
    private $collectionIdentifier;

    public function __construct(MongoDBManager $manager)
    {
        $this->databaseName = $_SERVER["DB_NAME"];
        $this->collectionName = 'item';
        $this->collectionIdentifier = $this->databaseName . '.' . $this->collectionName;

        $this->mongoManager = $manager;
    }

    public function get(): array
    {
        $query = new MongoDBQuery([]);

        $rows = $this->mongoManager->executeQuery($this->collectionIdentifier, $query);

        return $rows->toArray();
    }

    public function create(Item $item): Item
    {
        $bulk = new MongoDBBulkWrite;
        $objectId = new ObjectID(null);

        $document = $item->toArray();
        $document['_id'] = $objectId->getValue();

        $bulk->insert($document);

        $this->mongoManager->executeBulkWrite($this->collectionIdentifier, $bulk);

        $item->setId($objectId);

        return $item;
    }

    public function update(string $itemId, array $dataArray): array
    {
        $bulk = new MongoDBBulkWrite;

        $bulk->update(['_id' => $itemId], ['$set' => $dataArray]);

        $this->mongoManager->executeBulkWrite($this->collectionIdentifier, $bulk);

        return $this->getById($itemId);
    }

    public function delete(string $itemId): bool
    {
        $bulk = new MongoDBBulkWrite;

        $bulk->delete(['_id' => $itemId]);

        $bulkWriteResult = $this->mongoManager->executeBulkWrite($this->collectionIdentifier, $bulk);

        return !empty($bulkWriteResult->getDeletedCount());
    }

    public function getById(string $itemId): array
    {
        $filter = ['_id' => $itemId];
        $query = new MongoDBQuery($filter);

        $itemData = $this->mongoManager->executeQuery($this->collectionIdentifier, $query);

        return (array) current($itemData->toArray());
    }
}
