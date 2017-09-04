<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Resource\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;
use MSBios\Resource\Doctrine\Entity;

/**
 * Class PageType
 * @package MSBios\Resource\Doctrine\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="sys_t_page_types")
 */
class PageType implements
    IdentifierAwareInterface,
    TitleAwareInterface
{
    use IdentifierAwareTrait;
    use TitleAwareTrait;

    /**
     * @var Module
     *
     * @ORM\ManyToOne(targetEntity="Module")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="moduleid", referencedColumnName="id")
     * })
     */
    private $module;

    /**
     * @var string
     *
     * @ORM\Column(name="controller", type="string", length=100, nullable=false)
     */
    private $controller;

    /**
     * @var string
     *
     * @ORM\Column(name="action", type="string", length=100, nullable=false)
     */
    private $action;

    /**
     * @var string
     *
     * @ORM\Column(name="icon", type="string", length=20, nullable=false)
     */
    private $icon;

    /**
     * @return Module
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * @param Module $module
     */
    public function setModule($module)
    {
        $this->module = $module;
    }

    /**
     * @return string
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @param string $controller
     */
    public function setController($controller)
    {
        $this->controller = $controller;
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param string $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param string $icon
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
    }
}
