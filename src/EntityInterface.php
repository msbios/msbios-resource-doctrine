<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Resource\Doctrine;

/**
 * Interface EntityInterface
 * @package MSBios\Resource\Doctrine
 */
interface EntityInterface
{
    /**
     * @return mixed
     */
    public function getId();

    /**
     * @param $id
     * @return mixed
     */
    public function setId($id);
}
