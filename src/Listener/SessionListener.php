<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Resource\Doctrine\Listener;

use MSBios\Resource\Doctrine\Session\SaveHandler\DoctrineGateway;
use MSBios\Resource\Module;
use Zend\Config\Config;
use Zend\EventManager\EventInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Session\Config\SessionConfig;
use Zend\Session\Container;
use Zend\Session\SessionManager;

/**
 * Class SessionListener
 * @package MSBios\Resource\Listener
 */
class SessionListener
{
    /**
     * @param EventInterface $e
     */
    public function onDispatch(EventInterface $e)
    {
        /** @var ServiceLocatorInterface $serviceManager */
        $serviceManager = $e->getApplication()
            ->getServiceManager();

        /** @var Config $config */
        $config = $serviceManager
            ->get(Module::class)
            ->get('session');

        if ($config->get('enabled', false)) {

            /** @var SessionConfig $sessionConfig */
            $sessionConfig = new SessionConfig;
            $sessionConfig->setOptions($config->get('options'));

            /** @var SessionManager $sessionManager */
            $sessionManager = new SessionManager;
            $sessionManager->setConfig($sessionConfig);
            $sessionManager->setSaveHandler(
                $serviceManager->get(DoctrineGateway::class)
            );

            Container::setDefaultManager($sessionManager);
            $sessionManager->start();
        }
    }
}
