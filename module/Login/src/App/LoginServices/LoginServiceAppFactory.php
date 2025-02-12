<?php

namespace Login\App\LoginServices;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;
use Doctrine\ORM\EntityManager;


class LoginServiceAppFactory implements FactoryInterface {
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        return new LoginServiceApp(
            $container->get(EntityManager::class)
        );
    }
}