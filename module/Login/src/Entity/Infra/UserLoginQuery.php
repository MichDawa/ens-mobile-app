<?php

namespace Login\Entity\Infra;

use Doctrine\ORM\QueryBuilder;
use Login\Entity\UserLogin;

class UserLoginQuery {

    private $qb;

    function __construct(QueryBuilder $qb) {
        $this->qb = $qb;
    }

    /**
     * @return QueryBuilder
     */
    public function getQueryBuilder() {
        return $this->qb;
    }

    public function baseQuery() {
        $qb = $this->getQueryBuilder();
        $qb->select("u");
        $qb->from(UserLogin::class, "u");
        return $this;
    }

    public function addUsername($username) {
        $qb = $this->getQueryBuilder();
        $qb->andWhere($qb->expr()->eq("u.username", $qb->expr()->literal($username)));
        return $this;
    }

    public function addPassword($password) {
        $qb = $this->getQueryBuilder();
        $qb->andWhere($qb->expr()->eq("u.password", $qb->expr()->literal($password)));
        return $this;
    }

}