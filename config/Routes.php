<?php

declare (strict_types = 1);

use App\Controllers\ItemController;
use App\Controllers\LendController;
use App\Controllers\PreflightController;
use Slim\Routing\RouteCollectorProxy;

$app->group("/api/items", function (RouteCollectorProxy $group) {
    $group->get('', [ItemController::class, 'get']);
    $group->post('', [ItemController::class, 'post']);
    $group->options('', [PreflightController::class, 'options']);
    $group->put('/{id}', [ItemController::class, 'put']);
    $group->delete('/{id}', [ItemController::class, 'delete']);
    $group->options('/{id}', [PreflightController::class, 'options']);
});

$app->group("/api/lend", function (RouteCollectorProxy $group) {
    $group->get('', [LendController::class, 'get']);
    $group->post('', [LendController::class, 'post']);
    $group->options('', [PreflightController::class, 'options']);
    $group->delete('/{id}', [LendController::class, 'delete']);
    $group->options('/{id}', [PreflightController::class, 'options']);
});

$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}',
    function ($request, $response) {
        $responsePayload = json_encode(['error' => 'route not found']);
        $response->getBody()->write($responsePayload);
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(404);
    }
);
