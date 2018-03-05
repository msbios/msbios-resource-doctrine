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
        /** @var Paginator $paginator */
        $paginator = $this->buildPaginator($this->createQueryBuilder('ms'));
        $paginator->setDefaultItemCountPerPage($limit);
        $paginator->setCurrentPageNumber($page);
        return $paginator;
    }
}
