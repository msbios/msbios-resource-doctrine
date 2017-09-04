<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Resource\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;
use MSBios\Resource\Doctrine\Entity;

/**
 * Class Module
 * @package MSBios\Resource\Doctrine\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="sys_t_modules")
 */
class Module implements
    IdentifierAwareInterface,
    TitleAwareInterface
{
    use IdentifierAwareTrait;
    use TitleAwareTrait;

    /**
     * @var string
     *
     * @ORM\Column(name="module", type="string", length=100, nullable=false)
     */
    private $module;

    /**
     * @return string
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * @param $module
     * @return $this
     */
    public function setModule($module)
    {
        $this->module = $module;
        return $this;
    }
}