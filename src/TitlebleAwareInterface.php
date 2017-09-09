<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Resource\Doctrine;

/**
 * Interface TitlebleAwareInterface
 * @package MSBios\Resource\Doctrine
 */
interface TitlebleAwareInterface
{
    /**
     * @return string
     */
    public function getTitle();

    /**
     * @param $title
     * @return $this
     */
    public function setTitle($title);
}
