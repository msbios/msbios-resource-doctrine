<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBiosTest\Resource\Doctrine;

use MSBios\Resource\Doctrine\Module;
use PHPUnit\Framework\TestCase;

/**
 * Class ModuleTest
 * @package MSBiosTest\Resource\Doctrine
 */
class ModuleTest extends TestCase
{
    /**
     *
     */
    public function testGetConfig()
    {
        $this->assertInternalType('array', (new Module)->getConfig());
    }

    /**
     *
     */
    public function testGetAutoloaderConfig()
    {
        $this->assertInternalType('array', (new Module)->getAutoloaderConfig());
    }
}
