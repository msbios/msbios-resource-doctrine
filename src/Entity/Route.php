<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Resource\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Route
 * @package MSBios\Resource\Doctrine\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="sys_t_routes")
 */
class Route implements
    IdentifierAwareInterface
{
  use IdentifierAwareTrait;
}
