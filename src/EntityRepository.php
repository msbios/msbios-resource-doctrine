<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Resource\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\EntityRepository as DefaultEntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\QueryBuilder;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
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
    const DEFAULT_ALIAS = 'o';

    /** @var int */
    private static $placeholderCounter = 0;

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
     * @param null $orderBy
     * @param null $group
     * @param null $having
     * @return Paginator
     * @throws \Exception
     */
    public function fetchAll($where = null, $orderBy = null, $group = null, $having = null)
    {
        /** @var QueryBuilder $qb */
        $qb = $this->createQueryBuilder(static::DEFAULT_ALIAS);

        if ($where instanceof \Closure || (is_object($where) && method_exists($where, '__invoke'))) {

            /** @var QueryBuilderPaginator|AdapterInterface $adapter */
            $adapter = $where($qb, $orderBy, $group, $having);

            if (! ($adapter instanceof AdapterInterface)) {
                throw new \Exception('Must be AdapterInterface');
            }
        } else {
            /** @var QueryBuilderPaginator|AdapterInterface $adapter */
            $adapter = new QueryBuilderPaginator($qb, $where, $orderBy, $group, $having);
        }

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
        $id = (int) $object->getId();

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

    /**
     * @return string
     */
    protected function getAlias(): string
    {
        return mb_strtolower(end(explode('\\', $this->getEntityName())));
    }

    /**
     * @param \Traversable $filters
     * @param \Traversable $orders
     * @return array
     */
    public function fetchBy(\Traversable $filters = [], \Traversable $orders = []): array
    {

        $alias = $this->getAlias();
        $qb = $this->createQueryBuilder($alias);

        if ($filters) {
            $this->applyFilters($filters, $qb, $alias, $this->getClassName());
        }

        $this->applyOrder($orders ?: ['id' => 'DESC'], $qb, $alias, $this->getClassName());

        return $this->applyPagination( new Paginator(new DoctrineAdapter());, $qb);
    }

    /**
     * @param \Traversable $order
     * @param QueryBuilder $qb
     * @param string $alias
     * @param string $className
     */
    protected function applyOrder(\Traversable $order, QueryBuilder $qb, string $alias, string $className): void
    {
        $metadata = $this
            ->getEntityManager()
            ->getClassMetadata($className);

        $columns = $metadata->getFieldNames();

        $relationColumns = $metadata->getAssociationMappings();

        foreach ($order as $field => $value) {

            $column = $alias . '.' . $field;

            if (isset($relationColumns[$field]) && !\in_array($field, $qb->getAllAliases(), true)) {
                $qb->leftJoin($column, $field);
                $this->applyOrder($value, $qb, $field, $relationColumns[$field]['targetEntity']);
                continue;
            }

            if (!\in_array($field, $columns, true)) {
                continue;
            }

            $qb->addOrderBy($column, $value);
        }
    }

    /**
     *
     * <code>
     *     $this->applyFilters([
     *         'columnName1' => [
     *             'columnInherit1' => (int)value
     *         ],
     *         'columnName2' => [
     *             'columnInherit1' => [
     *                 'Operator::IN' => [
     *                     (int)value, (int)value, (int)value
     *                 ]
     *             ]
     *         ],
     *     ])
     * </code>
     *
     * @param \Traversable $filters
     * @param QueryBuilder $qb
     * @param string $alias
     * @param string $className
     */
    protected function applyFilters(\Traversable $filters, QueryBuilder $qb, string $alias, string $className): void
    {
         /** @var ClassMetadata $metadata */
         $metadata = $this->getEntityManager()->getClassMetadata($className);

         /** @var array $columns */
         $columns = $metadata->getFieldNames();

         /** @var array $relationColumns */
         $relationColumns = $metadata->getAssociationMappings();

        foreach ($filters as $field => $value) {

            $column = $alias . '.' . $field;

            if (isset($relationColumns[$field]) && !\in_array($field, $qb->getAllAliases(), true)) {
                $qb->leftJoin($column, $field);
                $this->applyFilters($value, $qb, $field, $relationColumns[$field]['targetEntity']);
                continue;
            }

            if (!\in_array($field, $columns, true)) {
                continue;
            }

            if (\is_array($value) && !empty($value) && \in_array(\key($value), Operator::ALL)) {
                foreach ($value as $operatorType => $operatorValue) {
                    $this->applyFilters([
                        $field => [
                            'operator' => $operatorType,
                            'value' => $operatorValue
                        ]
                    ], $qb, $alias, $className);
                }
                continue;
            }

            $operator = $value['operator'] ?? (\is_array($value) ? $operator = Operator::IN : Operator::EQUAL);
            $value = $value['value'] ?? $value;

            switch ($operator) {
                case (Operator::EQUAL):
                    $this->eq($qb, $column, $value);
                    break;
                case (Operator::NOT_EQUAL):
                    $this->neq($qb, $column, $value);
                    break;
                case (Operator::IN):
                    $this->in($qb, $column, $value);
                    break;
                case (Operator::NOT_IN):
                    $this->nin($qb, $column, $value);
                    break;
                case (Operator::LESS_THAN):
                    $this->lt($qb, $column, $value);
                    break;
                case (Operator::LESS_THAN_OR_EQUAL):
                    $this->lte($qb, $column, $value);
                    break;
                case (Operator::GREAT_THAN):
                    $this->gt($qb, $column, $value);
                    break;
                case (Operator::GREAT_THAN_OR_EQUAL):
                    self::gte($qb, $column, $value);
                    break;
                case (Operator::IS_NULL):
                    $this->isnull($qb, $column, $value);
                    break;
            }
        }
    }

    /**
     * @param QueryBuilder $qb
     * @param string $column
     * @param $value
     * @return $this
     */
    private function gt(QueryBuilder $qb, string $column, $value)
    {
        /** @var string $placeholder */
        $placeholder = $this->createPlaceholder($column);
        $qb->andWhere($qb->expr()->gt($column, ":{$placeholder}"))
            ->setParameter($placeholder, $value);

        return $this;
    }

    /**
     * @param QueryBuilder $qb
     * @param string $column
     * @param $value
     * @return $this
     */
    private function gte(QueryBuilder $qb, string $column, $value)
    {
        /** @var string $placeholder */
        $placeholder = $this->createPlaceholder($column);
        $qb->andWhere($qb->expr()->gte($column, ":{$placeholder}"))
            ->setParameter($placeholder, $value);

        return $this;
    }

    /**
     * @param QueryBuilder $qb
     * @param string $column
     * @param $value
     * @return $this
     */
    private function lt(QueryBuilder $qb, string $column, $value)
    {
        /** @var string $placeholder */
        $placeholder = $this->createPlaceholder($column);
        $qb->andWhere($qb->expr()->lt($column, ":{$placeholder}"))
            ->setParameter($placeholder, $value);

        return $this;
    }

    /**
     * @param QueryBuilder $qb
     * @param string $column
     * @param $value
     * @return $this
     */
    private function lte(QueryBuilder $qb, string $column, $value)
    {
        $placeholder = $this->createPlaceholder($column);
        $qb->andWhere($column . ' <= :' . $placeholder)
            ->setParameter($placeholder, $value);

        return $this;
    }

    /**
     * @param QueryBuilder $qb
     * @param string $column
     * @param $value
     * @return $this
     */
    private function eq(QueryBuilder $qb, string $column, $value)
    {
        /** @var string $placeholder */
        $placeholder = $this->createPlaceholder($column);
        $qb->andWhere($qb->expr()->eq($column, ":{$placeholder}"))
            ->setParameter($placeholder, $value);

        return $this;
    }

    /**
     * @param QueryBuilder $qb
     * @param string $column
     * @param $value
     * @return $this
     */
    private function neq(QueryBuilder $qb, string $column, $value)
    {
        $placeholder = $this->createPlaceholder($column);
        $qb->andWhere($column . ' <> :' . $placeholder)
            ->setParameter($placeholder, $value);

        return $this;
    }

    /**
     * @param QueryBuilder $qb
     * @param string $column
     * @param array $value
     * @return $this
     */
    private function in(QueryBuilder $qb, string $column, array $value)
    {
        $placeholder = $this->createPlaceholder($column);
        $qb->andWhere($column . ' IN (:' . $placeholder . ')')
            ->setParameter($placeholder, $value);

        return $this;
    }

    /**
     * @param QueryBuilder $qb
     * @param string $column
     * @param array $value
     * @return $this
     */
    private function nin(QueryBuilder $qb, string $column, array $value)
    {
        $placeholder = $this->createPlaceholder($column);
        $qb->andWhere($column . ' NOT IN (:' . $placeholder . ')')
            ->setParameter($placeholder, $value);

        return $this;
    }

    /**
     * @param QueryBuilder $qb
     * @param string $column
     * @param $value
     * @return $this
     */
    private function isnull(QueryBuilder $qb, string $column, $value)
    {
        $operator = $value ? 'IS NULL' : 'IS NOT NULL';
        $qb->andWhere($column . ' ' . $operator);

        return $this;
    }

    /**
     * @param string $name
     * @return string
     */
    private function createPlaceholder(string $name): string
    {
        return (str_replace('.', '_', $name) . ++self::$placeholderCounter);
    }

}
