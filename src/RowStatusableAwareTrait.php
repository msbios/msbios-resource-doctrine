<?php
/**
 * @access protected
 * @author Judzhin Miles <judzhin[at]gns-it.com>
 */
namespace MSBios\Resource\Doctrine;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait RowStatusableAwareTrait
 * @package MSBios\Resource\Doctrine\Entity
 */
trait RowStatusableAwareTrait
{
    /**
     * @var bool
     *
     * @ORM\Column(name="rowstatus", type="boolean")
     */
    private $rowStatus = true;

    /**
     * @return bool
     */
    public function isRowStatus()
    {
        return $this->rowStatus;
    }

    /**
     * @param $rowStatus
     * @return $this
     */
    public function setRowStatus($rowStatus)
    {
        $this->rowStatus = $rowStatus;
        return $this;
    }
}
