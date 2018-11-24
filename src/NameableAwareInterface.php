<?php
/**
 * @access protected
 * @author Judzhin Miles <judzhin[at]gns-it.com>
 */
namespace MSBios\Resource\Doctrine;

/**
 * Interface NameableAwareInterface
 * @package MSBios\Resource\Doctrine
 */
interface NameableAwareInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @param $name
     * @return $this
     */
    public function setName($name);
}