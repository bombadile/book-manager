<?php

return [
    'dependencies' => [
        'factories' => [
            PDO::class => App\Factory\PDOFactory::class,
        ]
    ],

    'pdo' => [
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ],
    ],
];
