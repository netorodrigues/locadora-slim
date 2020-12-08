<?php

declare (strict_types = 1);

use App\Factories\Contracts\ItemFactory;
use App\Factories\MongoItemFactory;
use App\Repositories\Contracts\ItemRepository;
use App\Repositories\MongoDB\MongoItemRepository;
use App\Services\Item\Contracts\CreateItemServiceInterface;
use App\Services\Item\CreateItemService;
use function DI\autowire as useInstance;
use Psr\Container\ContainerInterface;
use \MongoDB\Driver\Manager as MongoDBManager;

$connection = [
    MongoDBManager::class => static function (ContainerInterface $container): MongoDBManager {

        $databaseConfigurations = $container->get('settings')['db'];
        $connectionString = sprintf(
            "mongodb://%s:%s@%s:%s",
            $databaseConfigurations['user'],
            $databaseConfigurations['password'],
            $databaseConfigurations['hostname'],
            $databaseConfigurations['port']
        );

        $mongo = new MongoDBManager($connectionString);

        return $mongo;
    },
];

$factories = [
    ItemFactory::class => useInstance(MongoItemFactory::class),
];

$repositories = [
    ItemRepository::class => useInstance(MongoItemRepository::class),
];

$services = [
    CreateItemServiceInterface::class => useInstance(CreateItemService::class),
];

return array_merge(
    $connection,
    $factories,
    $repositories,
    $services
);
