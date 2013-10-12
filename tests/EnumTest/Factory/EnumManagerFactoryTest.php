<?php
namespace EnumTest\Factory;

use Enum\Factory\EnumManagerFactory;

class EnumManagerFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateService()
    {
        $adapter = $this->getMock('Enum\Adapter\AdapterInterface');

        $serviceLocator = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');
        $serviceLocator
            ->expects($this->any())
            ->method('get')
            ->will($this->returnValue($adapter));

        $factory = new EnumManagerFactory;
        $manager = $factory->createService($serviceLocator);

        $this->assertInstanceOf('Enum\EnumManager', $manager);
    }
}