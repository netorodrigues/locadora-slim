<?php

declare (strict_types = 1);

use Psr\Container\ContainerInterface;
use \MongoDB\Driver\Manager as MongoDBManager;

$container->set('mongoManager', function (ContainerInterface $container): MongoDBManager {

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
});
