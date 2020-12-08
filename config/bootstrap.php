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

require __DIR__ . '/Routes.php';

return $app;
