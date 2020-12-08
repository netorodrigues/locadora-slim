<?php

declare (strict_types = 1);

use App\Factories\Contracts\ItemFactory;
use App\Factories\Contracts\LendFactory;
use App\Factories\MongoItemFactory;
use App\Factories\MongoLendFactory;
use App\Repositories\Contracts\ItemRepository;
use App\Repositories\Contracts\LendRepository;
use App\Repositories\MongoDB\MongoItemRepository;
use App\Repositories\MongoDB\MongoLendRepository;
use App\Services\Item\Contracts\CreateItemServiceInterface;
use App\Services\Item\Contracts\DeleteItemServiceInterface;
use App\Services\Item\Contracts\EditItemServiceInterface;
use App\Services\Item\Contracts\GetItemsServiceInterface;
use App\Services\Item\CreateItemService;
use App\Services\Item\DeleteItemService;
use App\Services\Item\EditItemService;
use App\Services\Item\GetItemsService;
use App\Services\Lend\Contracts\CreateLendServiceInterface;
use App\Services\Lend\CreateLendService;
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

        $mongoManager = new MongoDBManager($connectionString);

        return $mongoManager;
    },
];

$factories = [
    ItemFactory::class => useInstance(MongoItemFactory::class),
    LendFactory::class => useInstance(MongoLendFactory::class),
];

$repositories = [
    ItemRepository::class => useInstance(MongoItemRepository::class),
    LendRepository::class => useInstance(MongoLendRepository::class),
];

$itemServices = [
    CreateItemServiceInterface::class => useInstance(CreateItemService::class),
    GetItemsServiceInterface::class => useInstance(GetItemsService::class),
    EditItemServiceInterface::class => useInstance(EditItemService::class),
    DeleteItemServiceInterface::class => useInstance(DeleteItemService::class),
];

$lendServices = [
    CreateLendServiceInterface::class => useInstance(CreateLendService::class),
];

return array_merge(
    $connection,
    $factories,
    $repositories,
    $itemServices,
    $lendServices
);
