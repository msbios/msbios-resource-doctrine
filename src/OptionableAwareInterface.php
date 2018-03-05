<?php
/**
 * @access protected
 * @author Judzhin Miles <judzhin[at]gns-it.com>
 */
namespace MSBios\Resource\Doctrine;

/**
 * Interface OptionableAwareInterface
 * @package MSBios\Resource\Doctrine
 */
interface OptionableAwareInterface
{
    /**
     * @return array
     */
    public function getOptions();

    /**
     * @param $options
     * @return $this
     */
    public function setOptions($options);
}
