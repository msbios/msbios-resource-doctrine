<?php
/**
 * @access protected
 * @author Judzhin Miles <judzhin[at]gns-it.com>
 */
namespace MSBios\Resource\Doctrine;

/**
 * Interface TimestampableAwareInterface
 * @package MSBios\Resource\Doctrine\Entity
 */
interface TimestampableAwareInterface
{
    /**
     * @return \DateTime|\DateTimeInterface
     */
    public function getCreatedAt();

    /**
     * @param \DateTimeInterface $createdAt
     * @return $this
     */
    public function setCreatedAt(\DateTimeInterface $createdAt);

    /**
     * @return \DateTime|\DateTimeInterface
     */
    public function getModifiedAt();

    /**
     * @param \DateTimeInterface $modifiedAt
     * @return $this
     */
    public function setModifiedAt(\DateTimeInterface $modifiedAt);
}
