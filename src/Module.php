<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbiosc.com>
 */
namespace MSBios\Resource\Doctrine;

use Doctrine\DBAL\Platforms\MySqlPlatform;
use Doctrine\ORM\EntityManager;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\Mvc\ApplicationInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class Module
 * @package MSBios\Resource\Doctrine
 */
class Module extends \MSBios\Module implements BootstrapListenerInterface
{
    /** @const VERSION */
    const VERSION = '1.0.46';

    /**
     * @inheritdoc
     *
     * @param EventInterface $e
     * @return array|void
     * @throws \Doctrine\DBAL\DBALException
     */
    public function onBootstrap(EventInterface $e)
    {
        /** @var ApplicationInterface $target */
        $target = $e->getTarget();

        /** @var ServiceLocatorInterface $serviceManager */
        $serviceManager = $target->getServiceManager();

        /** @var MySqlPlatform $platform */
        $platform = $serviceManager
            ->get(EntityManager::class)
            ->getConnection()
            ->getDatabasePlatform();
        $platform->registerDoctrineTypeMapping('enum', 'string');
    }
}
