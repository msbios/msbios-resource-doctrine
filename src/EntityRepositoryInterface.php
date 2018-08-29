<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Resource\Doctrine;

use Doctrine\ORM\EntityNotFoundException;
use Zend\Paginator\Paginator;

/**
 * Interface EntityRepositoryInterface
 * @package MSBios\Resource\Doctrine
 */
interface EntityRepositoryInterface
{
    /**
     * @param $id
     * @return EntityInterface
     * @throws EntityNotFoundException
     */
    public function fetch($id);

    /**
     * @param null $where
     * @param null $sort
     * @param null $order
     * @param null $group
     * @param null $having
     * @return Paginator
     */
    public function fetchAll($where = null, $sort = null, $order = null, $group = null, $having = null);

    /**
     * @param EntityInterface $object
     * @return EntityInterface
     * @throws \Exception
     */
    public function save(EntityInterface $object);

    /**
     * @param EntityInterface $object
     */
    public function delete(EntityInterface $object);
}
