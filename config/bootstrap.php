<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Middlewares\JSONBodyParserMiddleware;
use DI\ContainerBuilder;
use Slim\Factory\AppFactory;

$rootDir = __DIR__ . '/../';

$dotenv = Dotenv\Dotenv::createImmutable($rootDir);

$envFile = $rootDir . '.env';
if (file_exists($envFile)) {
    $dotenv->load();
}

$dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS', 'DB_PORT']);

$settings = require __DIR__ . '/Settings.php';

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions($settings);
$container = $containerBuilder->build();

AppFactory::setContainer($container);
$app = AppFactory::create();

$app->add(new JSONBodyParserMiddleware());

require __DIR__ . '/Connection.php';
require __DIR__ . '/Routes.php';

/* MONGODB SIMPLE INSERT EXAMPLE

$doc = ['id' => uniqid(''), 'name' => 'Test Insert', 'price' => 26700];

$bulk = new \MongoDB\Driver\BulkWrite;
$bulk->insert($doc);
$bulk->update(['name' => 'Audi'], ['$set' => ['price' => 52000]]);
$bulk->delete(['name' => 'Hummer']);

$container->get('mongoManager')->executeBulkWrite('testdb.cars', $bulk);

 */

return $app;
