<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Resource\Doctrine;

/**
 * Interface OrderKeyableAwareInterface
 * @package MSBios\Resource\Doctrine
 */
interface OrderKeyableAwareInterface
{
    /**
     * @return int
     */
    public function getOrderKey();

    /**
     * @param $orderKey
     * @return $this
     */
    public function setOrderKey($orderKey);
}
