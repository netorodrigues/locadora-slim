<?php

declare (strict_types = 1);

use App\Controllers\ItemController;
use Slim\Routing\RouteCollectorProxy;

$app->group("/api/items", function (RouteCollectorProxy $group) {
    $group->get('', [ItemController::class, 'get']);
    $group->post('', [ItemController::class, 'post']);
    $group->put('/{itemId}', [ItemController::class, 'put']);
    $group->delete('/{itemId}', [ItemController::class, 'delete']);
});
