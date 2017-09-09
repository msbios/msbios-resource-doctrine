<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Resource\Doctrine;

use Doctrine\ORM\Mapping as ORM;
use MSBios\Resource\Record;

/**
 * Class Entity
 * @package MSBios\Resource\Doctrine
 * @ORM\MappedSuperclass
 */
abstract class Entity extends Record implements EntityInterface, IdentifierAwareInterface
{
    use IdentifierAwareTrait;
}
