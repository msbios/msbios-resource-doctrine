<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Resource\Doctrine;

use Doctrine\ORM\Mapping as ORM;
use MSBios\Stdlib\Object;

/**
 * Class Entity
 * @package MSBios\Resource\Doctrine
 * @ORM\MappedSuperclass
 */
abstract class Entity extends Object implements EntityInterface
{
}
