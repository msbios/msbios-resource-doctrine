<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Resource\Doctrine;

/**
 * Interface ContentableAwareInterface
 * @package MSBios\Resource\Doctrine
 */
interface ContentableAwareInterface
{
    /**
     * @return string
     */
    public function getContent();

    /**
     * @param $content
     * @return $this
     */
    public function setContent($content);
}
