<?php

namespace Login\App\LoginServices;

use Doctrine\ORM\EntityManager;
use Application\Infra\Validation\ValidatorUtility;
use  Login\Repository\UserLoginRepository;

class LoginServiceApp {

    /**
     * @var UserLoginRepository
     */
    private $userLoginRepository;

    public function __construct(
        UserLoginRepository $userLoginRepository
    ) {
        $this->userLoginRepository = $userLoginRepository;
    }

    public function getByUsername( $params) {
        try {
            $validator = new ValidatorUtility();
            $validator->addStringValidator("username", true, "Username is required.");
            $validator->validateAndThrow($params);

            $username = $validator->getValue("username");
            $forReturn = $this->userLoginRepository->findByUsername($username);

            return $forReturn;
        } catch (\Exception $err) {
            $this->userLoginRepository->rollbackAndClose();
            throw $err;
        }
    }

}