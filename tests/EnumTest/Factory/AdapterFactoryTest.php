<?php
namespace EnumTest\Factory;

use Enum\Factory\AdapterFactory;

class AdapterFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateService()
    {
        $serviceLocator = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');
        
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
                $this->getMock('Enum\Adapter\AdapterInterface')
            ));

        $factory = new AdapterFactory;
        $adapter = $factory->createService($serviceLocator);

        $this->assertInstanceOf('Enum\Adapter\AdapterInterface', $adapter);
    }
}