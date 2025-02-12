<?php

namespace Login\Controller;

use Application\Logger\LogNames;
use Psr\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class LoginControllerFactory implements FactoryInterface {
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        /** @var \Monolog\Logger $logger */
        $logger = $container->get(LogNames::APP_LOG);
        
        return new LoginController($logger);
    }
}