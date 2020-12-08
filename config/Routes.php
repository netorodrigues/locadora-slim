<?php

declare (strict_types = 1);

use App\Controllers\ItemController;
use App\Controllers\LendController;
use Slim\Routing\RouteCollectorProxy;

$app->group("/api/items", function (RouteCollectorProxy $group) {
    $group->get('', [ItemController::class, 'get']);
    $group->post('', [ItemController::class, 'post']);
    $group->put('/{itemId}', [ItemController::class, 'put']);
    $group->delete('/{itemId}', [ItemController::class, 'delete']);
});

$app->group("/api/lend", function (RouteCollectorProxy $group) {
    $group->get('', [LendController::class, 'get']);
    $group->post('', [LendController::class, 'post']);
    $group->delete('/{itemId}', [LendController::class, 'delete']);
});
