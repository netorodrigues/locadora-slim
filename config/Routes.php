<?php

declare (strict_types = 1);

use App\Controllers\ItemController;

$app->get('/api/items', [ItemController::class, 'get']);
$app->post('/api/items', [ItemController::class, 'post']);
