<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbiosc.com>
 */
namespace MSBios\Resource\Doctrine;

use MSBios\ModuleInterface;

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
}