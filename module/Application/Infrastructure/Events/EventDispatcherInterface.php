<?php

namespace Application\Infrastructure\Events;

interface EventDispatcherInterface {
    public function dispatchDoctrineEvents();

    public function dispatchNonDoctrineEvents();
}
