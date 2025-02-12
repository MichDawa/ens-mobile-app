<?php

declare(strict_types=1);

namespace Application;

use Application\Infrastructure\Events\DoctrineEventSubscriber;
use Application\Infrastructure\Events\EventDispatcherInterface;
use Application\Infrastructure\Logging\LogNames;
use Laminas\Mvc\MvcEvent;

class Module {
    public function getConfig(): array {
        /** @var array $config */
        $config = include __DIR__ . '/../config/module.config.php';
        return $config;
    }

    public function getAutoloaderConfig() {
        return [
            'Laminas\ApiTools\Autoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src',
                ],
            ],
        ];
    }

}
