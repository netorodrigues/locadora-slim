<?php

use App\Middlewares\CorsMiddleware;
use DI\Bridge\Slim\Bridge as SlimApp;

$rootDir = __DIR__ . '/../';

$dotenv = Dotenv\Dotenv::createImmutable($rootDir);

$envFile = $rootDir . '.env';
if (file_exists($envFile)) {
    $dotenv->load();
}

$dotenv->required([
    'ENV_TYPE',
    'DB_HOST',
    'DB_NAME',
    'DB_USER',
    'DB_PASS',
    'DB_PORT',
]);

$container = require __DIR__ . '/Container.php';

$app = SlimApp::create($container);

$app->addBodyParsingMiddleware();
$app->add(new CorsMiddleware());
$app->addRoutingMiddleware();

require __DIR__ . '/Routes.php';

return $app;
