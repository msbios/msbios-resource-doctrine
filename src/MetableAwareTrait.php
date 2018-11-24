<?php
/**
 * @access protected
 * @author Judzhin Miles <judzhin[at]gns-it.com>
 */
namespace MSBios\Resource\Doctrine;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait MetableAwareTrait
 * @package MSBios\Resource\Doctrine
 */
trait MetableAwareTrait
{
    /**
     * @var string
     *
     * @ORM\Column(name="mtitle", type="string", length=500)
     */
    private $metaTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="mkeywords", type="string", length=500)
     */
    private $metaKeywords;

    /**
     * @var string
     *
     * @ORM\Column(name="mdescription", type="string", length=500)
     */
    private $metaDescription;

    /**
     * @return string
     */
    public function getMetaTitle()
    {
        return $this->metaTitle;
    }

    /**
     * @param $metaTitle
     * @return $this
     */
    public function setMetaTitle($metaTitle)
    {
        $this->metaTitle = $metaTitle;
        return $this;
    }

    /**
     * @return string
     */
    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }

    /**
     * @param $metaKeywords
     * @return $this
     */
    public function setMetaKeywords($metaKeywords)
    {
        $this->metaKeywords = $metaKeywords;
        return $this;
    }

    /**
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * @param $metaDescription
     * @return $this
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;
        return $this;
    }
}
