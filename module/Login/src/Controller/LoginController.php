<?php

namespace Login\Controller;

use Monolog\Logger;
use Laminas\View\Model\JsonModel;
use Application\Exception\ApplicationException;
use Application\Controller\BaseLogActionController;
use Login\App\LoginServices\LoginServiceApp;


class LoginController extends BaseLogActionController {

    /**
     * @var LoginServiceApp
     */
    private $loginServiceApp;

    public function __construct(
        Logger $log,
        LoginServiceApp $loginServiceApp
    ) {
        parent::__construct($log);
        $this->loginServiceApp = $loginServiceApp;
    }


    public function authAction() {
        try {
            $params = $this->getParams();

            $forReturn = $this->loginServiceApp->getByUsername($params);

            return new JsonModel([
                'id' => $forReturn,
            ]);
        } catch (\InvalidArgumentException $ex) {
            return $this->processApplicationError($ex);
        } catch (ApplicationException $ex) {
            return $this->processApplicationError($ex);
        } catch (\Exception $ex) {
            return $this->processUnexpectedError($ex);
        }
    }
}
