<?php

declare (strict_types = 1);

$databaseSettings = [
    'settings' => [
        'db' => [
            'hostname' => $_SERVER['DB_HOST'],
            'name' => $_SERVER['DB_NAME'],
            'user' => $_SERVER['DB_USER'],
            'password' => $_SERVER['DB_PASS'],
            'port' => $_SERVER['DB_PORT'],
        ],
    ],
];

return $databaseSettings;
