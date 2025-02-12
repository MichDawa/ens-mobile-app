<?php

declare(strict_types=1);

/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

$entityPaths = [
    __DIR__ . '/../../module/MobileApp/src/Entity',
    // Add more module entity paths here as needed
];

$drivers = [
    'MobileApp\\Entity' => 'mobileapp_entity',
    // Add more module drivers here as needed
];

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => \Doctrine\DBAL\Driver\PDO\MySQL\Driver::class,
                'params' => [
                    'host'     => 'localhost',
                    'port'     => '3306',
                    'charset'  => 'utf8mb4'
                ]
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