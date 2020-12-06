<?php

declare (strict_types = 1);

use App\Controllers\HelloController;

$app->get('/', HelloController::class . ':get');
