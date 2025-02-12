<?php

namespace Login\Repository;

use Login\Entity\UserLogin;
use Login\Entity\Infra\UserLoginQuery;
use Application\Infra\Cache\CacheNames;
use Application\Infra\Repository\BaseRepository;

class UserLoginRepository extends BaseRepository {

    const CACHE_LIFE = 3600;

    private function createQuery() {
        return new UserLoginQuery($this->getEntityManager()->createQueryBuilder());
    }

    /**
     * @param string $username
     * @return UserLogin
     */
    public function findByUsername(string $username) {
        $builder = $this->createQuery();
        $builder->baseQuery();
        $builder->addUsername($username);
        
        $qb = $builder->getQueryBuilder();
        $query = $qb->getQuery();
        return $query->getOneOrNullResult();
    }

    public function clearCache() {
        $cacheDriver = $this->getEntityManager()->getConfiguration()->getResultCacheImpl();
        $cacheDriver->delete(CacheNames::USER_LOGIN);
    }

}