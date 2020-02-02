<?php

declare(strict_types=1);

use App\Middleware\ErrorHandler\ErrorResponseGeneratorInterface;
use App\Factory\WhoopsErrorResponseGeneratorFactory;
use App\Factory\WhoopsRunFactory;

return [
    'dependencies' => [
        'factories' => [
            ErrorResponseGeneratorInterface::class => WhoopsErrorResponseGeneratorFactory::class,
            Whoops\RunInterface::class => WhoopsRunFactory::class,
        ],
    ],

    'doctrine' => [
        'configuration' => [
            'orm_default' => [
                'result_cache' => 'array',
                'metadata_cache' => 'array',
                'query_cache' => 'array',
                'hydration_cache' => 'array',
            ],
        ],
        'driver' => [
            'entities' => [
                'cache' => 'array',
            ],
        ],
    ],

    'debug' => true,
];
