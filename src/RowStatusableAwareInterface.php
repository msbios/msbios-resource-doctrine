<?php
/**
 * @access protected
 * @author Judzhin Miles <judzhin[at]gns-it.com>
 */
namespace MSBios\Resource\Doctrine;

/**
 * Interface RowStatusableAwareInterface
 * @package MSBios\Resource\Doctrine\Entity
 */
interface RowStatusableAwareInterface
{
    /**
     * @return bool
     */
    public function isRowStatus();

    /**
     * @param bool $rowStatus
     */
    public function setRowStatus($rowStatus);
}
