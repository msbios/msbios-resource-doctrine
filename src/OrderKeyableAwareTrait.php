<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Resource\Doctrine;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait OrderKeyableAwareTrait
 * @package MSBios\Resource\Doctrine
 */
trait OrderKeyableAwareTrait
{
    /**
     * @var int
     *
     * @ORM\Column(name="order_key", type="integer", options={"default" : 0})
     */
    private $orderKey = 0;

    /**
     * @return int
     */
    public function getOrderKey()
    {
        return $this->orderKey;
    }

    /**
     * @param $orderKey
     * @return $this
     */
    public function setOrderKey($orderKey)
    {
        $this->orderKey = $orderKey;
        return $this;
    }
}
