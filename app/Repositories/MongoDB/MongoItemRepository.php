<?php

namespace App\Repositories\MongoDB;

use App\Entities\Item;
use App\Entities\ValueObjects\MongoObjectID as ObjectId;
use App\Repositories\Contracts\ItemRepository;
use \MongoDB\Driver\BulkWrite as MongoDBBulkWrite;
use \MongoDB\Driver\Manager as MongoDBManager;

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
        return [];
    }

    public function create(Item $item): Item
    {
        $bulk = new MongoDBBulkWrite;
        $objectId = new ObjectID(null);

        $document = $item->toArray();
        $document['_id'] = $objectId->getValue();

        $bulk->insert($document);

        $result = $this->mongoManager->executeBulkWrite($this->collectionIdentifier, $bulk);

        $upsertedIds = $result->getUpsertedIds();
        $item->setId($objectId);

        return $item;
    }

    public function edit(string $itemId): Item
    {
        return new Item;
    }

    public function delete(string $itemId): bool
    {
        return false;
    }
}
