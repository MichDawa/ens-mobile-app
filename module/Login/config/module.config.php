<?php
 return [
    'controllers' => [
        'factories' => [
            \Login\Controller\LoginController::class => \Login\Controller\LoginControllerFactory::class,
        ]
    ],
    'service_manager' => [
        'factories' => [
            \Login\App\LoginServices\LoginServiceApp::class => \Login\App\LoginServices\LoginServiceApp::class,
        ]
    ],
    'delegators' => [
        \Login\App\LoginServices\LoginServiceApp::class => [
            0 => \Application\Logger\LoggerDelegatorFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'login.user-login' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/login/user-login/:action',
                    'defaults' => [
                        'controller' => \Login\Controller\LoginController::class,
                    ],
                ],
            ],
        ]
    ],
    'api-tools-versioning' => [
        'uri' => [
            0 => 'login.user-login',
        ],
    ],
    'api-tools-rpc' => [
        \Login\Controller\LoginController::class => [
            'service_name' => 'ConfirmBooking',
            'http_methods' => [
                0 => 'POST',
                1 => 'GET',
            ],
            'route_name' => 'login.user-login',
        ],
    ],
    'api-tools-content-negotiation' => [
        'controllers' => [
            \Login\Controller\LoginController::class => 'Json',
        ],
        'accept_whitelist' => [
            \Login\Controller\LoginController::class => [
                0 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            \Login\Controller\LoginController::class => [
                0 => 'application/json',
            ],
        ],
    ],
];