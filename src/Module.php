<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbiosc.com>
 */
namespace MSBios\Resource\Doctrine;

use Doctrine\ORM\EntityManager;
use MSBios\ModuleInterface;
use Zend\EventManager\EventInterface;
use Zend\Mvc\ApplicationInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class Module
 * @package MSBios\Resource\Doctrine
 */
class Module implements ModuleInterface
{
    /**
     * Returns configuration to merge with application configuration
     *
     * @return array|\Traversable
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    /**
     * Listen to the bootstrap event
     *
     * @param EventInterface $e
     * @return array
     */
    public function onBootstrap(EventInterface $e)
    {
        /** @var ApplicationInterface $target */
        $target = $e->getTarget();
        /** @var ServiceLocatorInterface $serviceManager */
        $serviceManager = $target->getServiceManager();
        /** @var  $platform */
        $platform = $serviceManager
            ->get(EntityManager::class)
            ->getConnection()
            ->getDatabasePlatform();
        $platform->registerDoctrineTypeMapping('enum', 'string');
        $platform->registerDoctrineTypeMapping('bit', 'boolean');
    }
}