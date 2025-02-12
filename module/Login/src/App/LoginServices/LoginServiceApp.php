<?php

namespace Login\App\LoginServices;

use Monolog\Logger;
use Doctrine\ORM\EntityManager;
use Laminas\View\Model\JsonModel;

class LoginServiceApp {
    
    private $entityManager;

    public function __construct(
        EntityManager $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    


}