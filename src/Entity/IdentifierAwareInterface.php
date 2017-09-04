<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Resource\Doctrine\Entity;

/**
 * Interface IdentifierAwareInterface
 * @package MSBios\Resource\Doctrine\Entity
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