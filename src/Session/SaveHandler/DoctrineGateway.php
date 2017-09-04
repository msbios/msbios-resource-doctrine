<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Resource\Session\SaveHandler;

use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use MSBios\Resource\Entity\Session;
use Zend\Session\SaveHandler\SaveHandlerInterface;

/**
 * Class DoctrineGateway
 * @package MSBios\Resource\Session\SaveHandler
 */
class DoctrineGateway implements SaveHandlerInterface
{
    /** @var  string Path */
    protected $path;

    /** @var  string Name */
    protected $name;

    /** @var integer Lifetime */
    protected $lifetime;

    /** @var EntityManager */
    protected $em;

    /**
     * DoctrineGateway constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * Open Session
     *
     * @param  string $path
     * @param  string $name
     * @return bool
     */
    public function open($path, $name)
    {
        $this->path = $path;
        $this->name = $name;
        $this->lifetime = ini_get('session.gc_maxlifetime');
        return true;
    }

    /**
     * Close session
     *
     * @return bool
     */
    public function close()
    {
        return true;
    }

    /**
     * Read session data
     *
     * @param string $id
     * @return string
     */
    public function read($id)
    {
        if ($entity = $this->em->find(Session::class, $id)) {
            if ($entity->getModified() + $entity->getLifetime() > time()) {
                return $entity->getData();
            }
            $this->destroy($id);
        }

        return '';
    }

    /**
     * Write session data
     *
     * @param string $id
     * @param string $data
     * @return bool
     */
    public function write($id, $data)
    {
        /** @var EntityRepository $repository */
        $repository = $this->em->getRepository(Session::class);

        if (! $entity = $repository->findOneBy(['id' => $id])) {

            /** @var Session $entity */
            $entity = new Session;
        }

        $entity->setId($id)
            ->setName($this->name)
            ->setData((string)$data)
            ->setModified(time())
            ->setLifetime($this->lifetime);

        $this->em->persist($entity);
        $this->em->flush();

        return true;
    }

    /**
     * Destroy session
     *
     * @param  string $id
     * @return bool
     */
    public function destroy($id)
    {
        /** @var Session $entity */
        $entity = $this->em->find(Session::class, $id);
        $this->em->remove($entity);
        $this->em->flush();
        return true;
    }

    /**
     * Garbage Collection
     *
     * @param int $maxlifetime
     * @return true
     */
    public function gc($maxlifetime)
    {
        /** @var array $collection */
        $collection = $this->em
            ->getRepository(Session::class)
            ->findAll();

        /** @var Criteria $criteria */
        $criteria = new Criteria;
        $criteria->andWhere($criteria->expr()->lt('modified', time() + $this->lifetime));

        $this->em->remove($collection->matching($criteria));
        $this->em->flush();

        return true;
    }
}
