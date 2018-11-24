<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Resource\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;
use MSBios\Resource\Doctrine\Entity;
use MSBios\Resource\Doctrine\RowStatusableAwareInterface;
use MSBios\Resource\Doctrine\RowStatusableAwareTrait;
use MSBios\Resource\Doctrine\TimestampableAwareInterface;
use MSBios\Resource\Doctrine\TimestampableAwareTrait;
use MSBios\Resource\Doctrine\TitleableAwareInterface;
use MSBios\Resource\Doctrine\TitleableAwareTrait;

/**
 * Class Layout
 * @package MSBios\Resource\Doctrine\Entity
 *
 * @ORM\Entity(repositoryClass="MSBios\Resource\Doctrine\Repository\LayoutRepository")
 * @ORM\Table(name="sys_t_layouts")
 */
class Layout extends Entity implements
    TitleableAwareInterface,
    TimestampableAwareInterface,
    RowStatusableAwareInterface
{
    use TitleableAwareTrait;
    use TimestampableAwareTrait;
    use RowStatusableAwareTrait;

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
     * @param $template
     * @return $this
     */
    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }
}
