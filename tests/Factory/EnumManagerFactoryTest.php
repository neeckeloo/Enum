<?php
namespace EnumTest\Factory;

use Enum\Adapter\AdapterInterface;
use Enum\EnumManager;
use Enum\Factory\EnumManagerFactory;
use Interop\Container\ContainerInterface;

class EnumManagerFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateService()
    {
        $adapter = $this->createMock(AdapterInterface::class);

        $container = $this->createMock(ContainerInterface::class);
        $container
            ->method('get')
            ->will($this->returnValue($adapter));

        $factory = new EnumManagerFactory;
        $manager = $factory($container);

        $this->assertInstanceOf(EnumManager::class, $manager);
    }
}
