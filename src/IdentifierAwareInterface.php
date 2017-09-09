<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Resource\Doctrine;

/**
 * Interface IdentifierAwareInterface
 * @package MSBios\Resource\Doctrine
 */
interface IdentifierAwareInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     */
    public function setId($id);
}