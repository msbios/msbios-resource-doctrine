<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Resource\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;
use MSBios\Resource\Doctrine\Entity;

/**
 * Class Layout
 * @package MSBios\Resource\Doctrine\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="sys_t_layouts")
 */
class Layout implements
//     IdentifierAwareInterface,
    TitleAwareInterface
{
    use IdentifierAwareTrait;
    use TitleAwareTrait;

    /**
     * @var string
     *
     * @ORM\Column(name="template", type="string", length=255, nullable=false)
     */
    private $template;

    /**
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param string $template
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    }
}
