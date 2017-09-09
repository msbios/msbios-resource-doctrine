<?php
/**
 * @access protected
 * @author Judzhin Miles <judzhin[at]gns-it.com>
 */
namespace MSBios\Resource\Doctrine;

use Doctrine\ORM\Mapping AS ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Trait TimestampableAwareTrait
 * @package MSBios\Resource\Doctrine\Entity
 */
trait TimestampableAwareTrait
{
    /**
     * @var \DateTimeInterface
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="createdat", type="datetime")
     */
    private $createdAt = '0000-00-00 00:00:00';

    /**
     * @var \DateTimeInterface
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="modifiedat", type="datetime")
     */
    private $modifiedAt = '0000-00-00 00:00:00';

    /**
     * @return \DateTime|\DateTimeInterface
     */
    public function getCreatedAt()
    {
        if (!$this->createdAt instanceof \DateTimeInterface) {
            $this->createdAt = new \DateTime('now');
        }
        return $this->createdAt;
    }

    /**
     * @param \DateTimeInterface $createdAt
     * @return $this
     */
    public function setCreatedAt(\DateTimeInterface $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \DateTime|\DateTimeInterface
     */
    public function getModifiedAt()
    {
        if (!$this->modifiedAt instanceof \DateTimeInterface) {
            $this->modifiedAt = new \DateTime('now');
        }
        return $this->modifiedAt;
    }

    /**
     * @param \DateTimeInterface $modifiedAt
     * @return $this
     */
    public function setModifiedAt(\DateTimeInterface $modifiedAt)
    {
        $this->modifiedAt = $modifiedAt;
        return $this;
    }
}