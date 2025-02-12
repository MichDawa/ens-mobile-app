<?php

namespace Login\Controller;

use Monolog\Logger;
use Laminas\View\Model\JsonModel;
use Application\Exception\ApplicationException;
use Application\Controller\BaseLogActionController;


class LoginController extends BaseLogActionController {

    public function __construct(
        Logger $log,
    ) {
        parent::__construct($log);
    }

    public function authAction() {
        try {
            $params = $this->getParams();

            return new JsonModel(["success" => true]);
        } catch (\InvalidArgumentException $ex) {
            return $this->processApplicationError($ex);
        } catch (ApplicationException $ex) {
            return $this->processApplicationError($ex);
        } catch (\Exception $ex) {
            return $this->processUnexpectedError($ex);
        }
    }
}
