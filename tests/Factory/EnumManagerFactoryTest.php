<?php
namespace EnumTest\Factory;

use Enum\Adapter\AdapterInterface;
use Enum\EnumManager;
use Enum\Factory\EnumManagerFactory;
use Zend\ServiceManager\ServiceLocatorInterface;

class EnumManagerFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateService()
    {
        $adapter = $this->createMock(AdapterInterface::class);

        $serviceLocator = $this->createMock(ServiceLocatorInterface::class);
        $serviceLocator
            ->method('get')
            ->will($this->returnValue($adapter));

        $factory = new EnumManagerFactory;
        $manager = $factory->createService($serviceLocator);

        $this->assertInstanceOf(EnumManager::class, $manager);
    }
}
