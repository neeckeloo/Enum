<?php
namespace EnumTest\Factory;

use Enum\Factory\DoctrineOptionsFactory;

class DoctrineOptionsFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateService()
    {
        $serviceLocator = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');

        $serviceLocator
            ->expects($this->once())
            ->method('get')
            ->with('Config')
            ->will($this->returnValue(array(
                'enum' => array(
                    'options' => array(),
                ),
            )));

        $factory = new DoctrineOptionsFactory;
        $adapter = $factory->createService($serviceLocator);

        $this->assertInstanceOf('Enum\Options\DoctrineOptions', $adapter);
    }
}