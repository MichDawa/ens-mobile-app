<?php

namespace Application\Infra\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

class BaseRepository {

    const DEFAULT_NUM_ITEMS_PER_PAGE = 10;

    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager() {
        return $this->em;
    }

    public function persist($entity) {
        $this->getEntityManager()->persist($entity);
    }

    public function beginTransaction() {
        $em = $this->getEntityManager();
        $em->getConnection()->beginTransaction();
    }

    public function flush($entity = null) {
        $this->getEntityManager()->flush($entity);
    }

    public function commit() {
        if ($this->isTransactionActive()) {
            $this->getEntityManager()->getConnection()->commit();
        }
    }

    public function flushAndCommit() {
        $this->flush();
        $this->commit();
    }

    public function isTransactionActive() {
        return $this->getEntityManager()->getConnection()->isTransactionActive();
    }

    public function rollback() {
        if ($this->isTransactionActive()) {
            $this->getEntityManager()->getConnection()->rollBack();
        }
    }

    public function rollbackAndClose() {
        if ($this->isTransactionActive()) {
            $this->getEntityManager()->getConnection()->rollBack();
            $this->getEntityManager()->close();
        }
    }

    public function remove($entity) {
        $this->getEntityManager()->remove($entity);
    }
    
    public function clearEntityManager() {
        $this->getEntityManager()->clear();
    }

    public function getFirstResult($page, $maxResult = self::DEFAULT_NUM_ITEMS_PER_PAGE) {
        return ($page - 1) * $maxResult;
    }

    /**
     * @param $query
     * @param $currentPage
     * @param $maxResults
     * @return Query
     */
    protected function getResultPagination($query, $currentPage, $maxResults = self::DEFAULT_NUM_ITEMS_PER_PAGE) {
        $doctrineQuery = $query->setFirstResult($this->getFirstResult($currentPage, $maxResults))
                ->setMaxResults($maxResults);

        return $doctrineQuery;
    }

    protected function toLiteralList($list, QueryBuilder $qb) {
        $forReturn = [];
        foreach ($list as $forLiteral) {
            $forReturn[] = $qb->expr()->literal($forLiteral);
        }
        return $forReturn;
    }

}
