<?php

namespace Application\Settings;

use Psr\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class AppSettingsFactory implements FactoryInterface {
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        return new AppSettings(
            $container->get("Config")->toArray()
        );
    }

}
