<?php
/**
 * @access protected
 * @author Judzhin Miles <judzhin[at]gns-it.com>
 */
namespace MSBios\Resource\Doctrine;

/**
 * Interface MetableAwareInterface
 * @package MSBios\Resource\Doctrine
 */
interface MetableAwareInterface
{
    /**
     * @return string
     */
    public function getMetaTitle();

    /**
     * @param $metaTitle
     * @return $this
     */
    public function setMetaTitle($metaTitle);

    /**
     * @return string
     */
    public function getMetaKeywords();

    /**
     * @param $metaKeywords
     * @return $this
     */
    public function setMetaKeywords($metaKeywords);

    /**
     * @return string
     */
    public function getMetaDescription();

    /**
     * @param $metaDescription
     * @return $this
     */
    public function setMetaDescription($metaDescription);
}
