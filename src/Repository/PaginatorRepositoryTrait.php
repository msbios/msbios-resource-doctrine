<?php
/**
 * @access protected
 * @author Judzhin Miles <judzhin[at]gns-it.com, info[woof-woof]msbios.com>
 */

namespace MSBios\Resource\Doctrine\Repository;

use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Zend\Paginator\Adapter\AdapterInterface;
use Zend\Paginator\Paginator;

/**
 * Trait PaginatorRepositoryTrait
 * @package MSBios\Resource\Doctrine\Repository
 */
trait PaginatorRepositoryTrait
{
    /**
     * @param QueryBuilder $qb
     * @return Query
     */
    protected function buildQuery(QueryBuilder $qb)
    {
        return $qb->getQuery();
    }

    /**
     * @param QueryBuilder $qb
     * @return Paginator
     */
    protected function buildPaginator(QueryBuilder $qb)
    {
        /** @var Query $query */
        $query = $this->buildQuery($qb);

        /** @var AdapterInterface $adapter */
        $adapter = new DoctrineAdapter(
            new ORMPaginator($query, false)
        );

        return new Paginator($adapter);
    }

    /**
     * @param int $page
     * @param int $limit
     * @return Paginator
     */
    public function getPaginator($page = 1, $limit = 20)
    {
        return $this->getPaginatorWith(function (QueryBuilder $qb) {
            return $qb;
        }, $page, $limit);
    }

    /**
     * @param callable $closure
     * @param int $page
     * @param int $limit
     */
    public function getPaginatorWith(callable $closure, $page = 1, $limit = 20)
    {
        /** @var QueryBuilder $qb */
        $qb = $this->createQueryBuilder('ms');

        /** Execute colosure */
        $closure($qb);

        /** @var Paginator $paginator */
        $paginator = $this->buildPaginator($qb);
        $paginator->setDefaultItemCountPerPage($limit);
        $paginator->setCurrentPageNumber($page);
        return $paginator;
    }
}
