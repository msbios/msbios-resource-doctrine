<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Resource\Doctrine;

/**
 * Interface IdentifierableAwareInterface
 * @package MSBios\Resource\Doctrine
 */
interface IdentifierableAwareInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @param $id
     * @return mixed
     */
    public function setId($id);
}
