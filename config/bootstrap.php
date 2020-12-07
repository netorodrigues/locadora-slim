<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Middlewares\JSONBodyParserMiddleware;
use DI\Bridge\Slim\Bridge as SlimApp;
use DI\ContainerBuilder;

$rootDir = __DIR__ . '/../';

$dotenv = Dotenv\Dotenv::createImmutable($rootDir);

$envFile = $rootDir . '.env';
if (file_exists($envFile)) {
    $dotenv->load();
}

$dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS', 'DB_PORT']);

$settings = require __DIR__ . '/Settings.php';
$dependencies = require __DIR__ . '/Dependencies.php';

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions($settings);
$containerBuilder->addDefinitions($dependencies);
$container = $containerBuilder->build();

$app = SlimApp::create($container);

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
