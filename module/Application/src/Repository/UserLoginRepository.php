<?php

namespace Application\Repository;

use Doctrine\ORM\EntityRepository;
use Application\Entity\UserLogin;

class UserLoginRepository extends EntityRepository {
    public function findByUsername(string $username): ?UserLogin {
        return $this->createQueryBuilder('u')
            ->where('u.username = :username')
            ->setParameter('username', $username)
            ->getQuery()
            ->getOneOrNullResult();
    }
}