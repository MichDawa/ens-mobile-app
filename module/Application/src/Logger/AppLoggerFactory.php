<?php

namespace Application\Logger;

use Assert\Assertion;
use Psr\Container\ContainerInterface;
use Monolog\ErrorHandler;
use Monolog\Formatter\JsonFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\IntrospectionProcessor;
use Monolog\Processor\WebProcessor;
use Laminas\ServiceManager\Factory\FactoryInterface;

class AppLoggerFactory implements FactoryInterface {

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        $config = $container->get('Config')->toArray();
        $logConfig = $config["bt-log"] ;//?? null;
        Assertion::notEmpty($logConfig, "Log Config not found.");

        $appLog = $logConfig["app-log"] ;//?? null;
        Assertion::notNull($appLog, "Can not find configuration for app-log");

        $name = $appLog["name"];
        $path = $appLog["path"];
        $logLevel = $appLog["level"];

        $log = new Logger($name);

        $stream = new StreamHandler($path, $logLevel);

//        $formatter = new JsonFormatter();
//        $stream->setFormatter($formatter);

        $log->pushHandler($stream);

        //processors
        $log->pushProcessor(new WebProcessor());
        $log->pushProcessor(new IntrospectionProcessor());
        $log->pushProcessor(new UserAndPostDataProcessor());

        $handler = new ErrorHandler($log);
        $handler->registerErrorHandler([], false);
        $handler->registerExceptionHandler();
        $handler->registerFatalHandler();
        
        return $log;
    }

}
