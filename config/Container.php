<?php

declare (strict_types = 1);

use DI\ContainerBuilder;

$settings = require __DIR__ . '/Settings.php';
$dependencies = require __DIR__ . '/Dependencies.php';

$containerBuilder = new ContainerBuilder();

$containerBuilder->addDefinitions($settings);
$containerBuilder->addDefinitions($dependencies);

$container = $containerBuilder->build();

return $container;
