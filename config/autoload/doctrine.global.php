<?php

return [
    'dependencies' => [
        'factories'  => [
            Doctrine\ORM\EntityManagerInterface::class => ContainerInteropDoctrine\EntityManagerFactory::class,
        ],
    ],

    'doctrine' => [
        'configuration' => [
            'orm_default' => [
                'result_cache' => 'filesystem',
                'metadata_cache' => 'filesystem',
                'query_cache' => 'filesystem',
                'hydration_cache' => 'filesystem',
                'proxy_dir' => 'var/cache/doctrine',
            ],
        ],
        'connection' => [
            'orm_default' => [
                'driver_class' => Doctrine\DBAL\Driver\PDOMySql\Driver::class,
                'pdo' => PDO::class,
                'proxy_dir' => 'var/cache/doctrine',
            ],
        ],
        'driver' => [
            'entities' => [
                'class' => Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'filesystem',
                'paths' => [
                    'app/Model'
                ],
            ],
            'orm_default' => [
                'class' => Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain::class,
                'drivers' => [
                    'App\Model' => 'entities',
                ],
                'proxy_dir' => 'var/cache/doctrine',
            ]
        ],
        'cache' => [
            'filesystem' => [
                'class' => Doctrine\Common\Cache\FilesystemCache::class,
                'directory' => 'var/cache/doctrine',
            ],
        ],
    ],
];
