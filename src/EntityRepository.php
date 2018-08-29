<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Resource\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\EntityRepository as DefaultEntityRepository;
use Doctrine\ORM\QueryBuilder;
use MSBios\Paginator\Doctrine\Adapter\QueryBuilderPaginator;
use Zend\Paginator\Adapter\AdapterInterface;
use Zend\Paginator\Paginator;

/**
 * Class EntityRepository
 * @package MSBios\Resource\Doctrine
 */
class EntityRepository extends DefaultEntityRepository
{
    /** @const DEFAULT_ALIAS */
    const DEFAULT_ALIAS = ObjectRepository::class;

    /**
     * @param $id
     * @return EntityInterface
     * @throws EntityNotFoundException
     */
    public function fetch($id)
    {
        /** @var EntityInterface $entity */
        if ($entity = $this->find($id)) {
            return $entity;
        };

        throw new EntityNotFoundException;
    }

    /**
     * @param null $where
     * @param null $sort
     * @param null $order
     * @param null $group
     * @param null $having
     * @return Paginator
     */
    public function fetchAll($where = null, $sort = null, $order = null, $group = null, $having = null)
    {
        /** @var QueryBuilder $qb */
        $qb = $this->createQueryBuilder(self::DEFAULT_ALIAS);

        /** @var AdapterInterface $adapter */
        $adapter = new QueryBuilderPaginator($qb, $where, $sort, $order, $group, $having);

        return new Paginator($adapter);
    }

    /**
     * @param EntityInterface $object
     * @return EntityInterface
     * @throws \Exception
     */
    public function save(EntityInterface $object)
    {
        /** @var int $id */
        $id = (int)$object->getId();

        /** @var ObjectManager $em */
        $em = $this->getEntityManager();

        if (! $id) {
            $em->persist($object);
            $em->flush();
            return $object;
        }
        try {
            if ($this->fetch($id)) {
                $em->merge($object);
                $em->flush();
                return $object;
            }
        } catch (EntityNotFoundException $exception) {
            throw new \Exception('Object with id does not exist!');
        }
    }

    /**
     * @param EntityInterface $object
     */
    public function delete(EntityInterface $object)
    {
        /** @var ObjectManager $em */
        $em = $this->getEntityManager();
        $em->remove($object);
        $em->flush();
    }
}