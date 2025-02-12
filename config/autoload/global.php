<?php

declare(strict_types=1);

$entityPaths = [
    __DIR__ . '/../../module/Application/src/Entity',
];

$drivers = [
    // 'Application\\Entity' => 'mobileapp_entity',
    'Login\\Entity' => 'mobileapp_entity',
];

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => \Doctrine\DBAL\Driver\PDO\MySQL\Driver::class,
            ]
        ],
        'configuration' => [
            'orm_default' => [
                'metadata_cache'    => 'array',
                'query_cache'       => 'array',
                'result_cache'      => 'array',
                'hydration_cache'   => 'array',
                'generate_proxies'  => true,
                'proxy_dir'        => 'data/cache/DoctrineORMModule/Proxy',
                'proxy_namespace'  => 'DoctrineORMModule\Proxy',
            ]
        ],
        'entitymanager' => [
            'orm_default' => [
                'connection'    => 'orm_default',
                'configuration' => 'orm_default',
            ],
        ],
        'driver' => [
            'ens_entity' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AttributeDriver::class,
                'cache' => 'array',
                'paths' => $entityPaths
            ],
            'orm_default' => [
                'drivers' => $drivers
            ],
        ],
        'cache' => [
            'adapter' => [
                'name' => 'filesystem',
                'options' => [
                    'cache_dir' => 'data/cache',
                ],
            ],
            'plugins' => [
                'exception_handler' => ['throw_exceptions' => true],
                'serializer',
            ],
        ],
    ],
];