<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Resource\Doctrine\Factory;

use DoctrineModule\Cache\ZendStorageCache;
use Interop\Container\ContainerInterface;
use Zend\Cache\Storage\Adapter\Memory;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class DoctrineCacheFactory
 * @package MSBios\Resource\Factory
 */
class DoctrineCacheFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return ZendStorageCache
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /* I've added the additional line below that could be used as an
         * example to the other cache handlers that are available.
         * By default it's set to use ZendStorageCache (Enabled above)
         */
        // $cache = new \Doctrine\Common\Cache\FilesystemCache("data/cache");

        return new ZendStorageCache(new Memory);
    }
}
