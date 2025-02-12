<?php

declare(strict_types=1);

namespace Application;

use Application\Infrastructure\Events\DoctrineEventSubscriber;
use Application\Infrastructure\Events\EventDispatcherInterface;
use Application\Infrastructure\Logging\LogNames;
use Application\Settings\AppSettings;
use Laminas\Mvc\MvcEvent;
use Laminas\Uri\UriFactory;
use Laminas\Uri\Uri;

class Module {
    public function getConfig(): array {
        /** @var array $config */
        $config = include __DIR__ . '/../config/module.config.php';
        return $config;
    }

    public function onBootstrap(MvcEvent $event) {
        $application = $event->getApplication();

        $serviceManager = $application->getServiceManager();
        $viewModel = $application->getMvcEvent()->getViewModel();

        $appSettings = $serviceManager->get(AppSettings::class);
        $viewModel->setVariable("version", $appSettings->getVersion());

        UriFactory::registerScheme('capacitor', Uri::class);

        $sharedEventManager = $application->getEventManager();
        $sharedEventManager->attach(MvcEvent::EVENT_DISPATCH, [$this, "onRender"]);
    }

    public function onRender(MvcEvent $event) {
        $application = $event->getApplication();
        $serviceManager = $application->getServiceManager();
        $logger = $serviceManager->get(LogNames::APP_LOG);
        try {
//            $logger->info("beforeEventDispatch");
            
            $dispatcher = $serviceManager->get(EventDispatcherInterface::class);
            $dispatcher->dispatchNonDoctrineEvents();

//            $logger->info("afterEventDispatch");
        } catch (\Exception $e) {
            $logger->critical($e->getMessage(), $e->getTrace());
        }
    }

}
