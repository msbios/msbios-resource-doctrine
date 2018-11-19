<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Resource\Doctrine;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Entity
 * @package MSBios\Resource\Doctrine
 * @ORM\MappedSuperclass
 */
abstract class Entity implements EntityInterface, IdentifierableAwareInterface
{
    use IdentifierAwareTrait;
}
