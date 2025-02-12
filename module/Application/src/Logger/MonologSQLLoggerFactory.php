<?php

namespace Application\Logger;

use Assert\Assertion;
use Psr\Container\ContainerInterface;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Laminas\ServiceManager\Factory\FactoryInterface;

class MonologSQLLoggerFactory implements FactoryInterface {

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        $config = $container->get('Config');

        if (!is_array($config)) {
            if (method_exists($config, 'toArray')) {
                $config = $config->toArray();
            } else {
                $config = (array)$config;
            }
        }

        $logConfig = $config["bt-log"];
        Assertion::notEmpty($logConfig, "Log Config not found.");

        $appLog = $logConfig["sql-log"];
        Assertion::notNull($appLog, "Can not find configuration for sql-log");

        $name = $appLog["name"];
        $path = $appLog["path"];
        $logLevel = $appLog["level"];

        $log = new Logger($name);
        $stream = new StreamHandler($path, $logLevel);
        $log->pushHandler($stream);

        $log = new Logger("sql-logger");
        $sqlLogger = new MonologSQLLogger($log);

        return $sqlLogger;
    }
}
