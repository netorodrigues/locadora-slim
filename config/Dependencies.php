<?php

declare (strict_types = 1);

use App\Factories\Contracts\ItemFactoryInterface;
use App\Factories\Contracts\LendFactoryInterface;
use App\Factories\ItemFactory;
use App\Factories\LendFactory;
use App\Repositories\Contracts\ItemRepository;
use App\Repositories\Contracts\LendRepository;
use App\Repositories\InMemoryItemRepository;
use App\Repositories\InMemoryLendRepository;
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
use App\Services\Lend\Contracts\DeleteLendServiceInterface;
use App\Services\Lend\Contracts\GetLendsServiceInterface;
use App\Services\Lend\CreateLendService;
use App\Services\Lend\DeleteLendService;
use App\Services\Lend\GetLendsService;
use function DI\autowire as useInstance;
use Psr\Container\ContainerInterface;
use \MongoDB\Driver\Manager as MongoDBManager;

$environment = getenv('ENV_TYPE');

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
    ItemFactoryInterface::class => useInstance(ItemFactory::class),
    LendFactoryInterface::class => useInstance(LendFactory::class),
];

$repositories = [
    ItemRepository::class => useInstance(MongoItemRepository::class),
    LendRepository::class => useInstance(MongoLendRepository::class),
];

$testRepositories = [
    ItemRepository::class => useInstance(InMemoryItemRepository::class),
    LendRepository::class => useInstance(InMemoryLendRepository::class),
];

$itemServices = [
    CreateItemServiceInterface::class => useInstance(CreateItemService::class),
    GetItemsServiceInterface::class => useInstance(GetItemsService::class),
    EditItemServiceInterface::class => useInstance(EditItemService::class),
    DeleteItemServiceInterface::class => useInstance(DeleteItemService::class),
];

$lendServices = [
    CreateLendServiceInterface::class => useInstance(CreateLendService::class),
    GetLendsServiceInterface::class => useInstance(GetLendsService::class),
    DeleteLendServiceInterface::class => useInstance(DeleteLendService::class),
];

return array_merge(
    $connection,
    $factories,
    $environment === 'TEST' ? $testRepositories : $repositories,
    $itemServices,
    $lendServices
);
