<?php
namespace EnumTest\Factory;

use Enum\Adapter\AdapterInterface;
use Enum\Factory\AdapterFactory;
use Zend\ServiceManager\ServiceLocatorInterface;

class AdapterFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateService()
    {
        $serviceLocator = $this->createMock(ServiceLocatorInterface::class);
        
        $serviceLocator
            ->expects($this->at(0))
            ->method('get')
            ->with('Config')
            ->will($this->returnValue(array(
                'enum' => array(
                    'adapter' => 'Enum\Adapter\Adapter'
                ),
            )));

        $serviceLocator
            ->expects($this->at(1))
            ->method('get')
            ->with('Enum\Adapter\Adapter')
            ->will($this->returnValue(
                $this->createMock(AdapterInterface::class)
            ));

        $factory = new AdapterFactory;
        $adapter = $factory->createService($serviceLocator);

        $this->assertInstanceOf(AdapterInterface::class, $adapter);
    }
}
