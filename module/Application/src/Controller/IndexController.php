<?php

declare(strict_types=1);

namespace MobileApp\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Laminas\ApiTools\Admin\Module as AdminModule;

class IndexController extends AbstractActionController {
    public function indexAction() {
        if (class_exists(AdminModule::class, false)) {
            return $this->redirect()->toRoute('api-tools/ui');
        }
        return new ViewModel();
    }
}
