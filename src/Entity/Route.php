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
use MSBios\Resource\Doctrine\TitleAwareInterface;
use MSBios\Resource\Doctrine\TitleAwareTrait;

/**
 * Class Route
 * @package MSBios\Resource\Doctrine\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="sys_t_routes")
 */
class Route extends Entity implements
    TitleAwareInterface,
    TimestampableAwareInterface,
    RowStatusableAwareInterface
{
    use TitleAwareTrait;
    use TimestampableAwareTrait;
    use RowStatusableAwareTrait;
}
