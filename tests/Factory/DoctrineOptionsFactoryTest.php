<?php
namespace EnumTest\Factory;

use Enum\Factory\DoctrineOptionsFactory;
use Enum\Options\DoctrineOptions;
use Zend\ServiceManager\ServiceLocatorInterface;

class DoctrineOptionsFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateService()
    {
        $serviceLocator = $this->createMock(ServiceLocatorInterface::class);

        $serviceLocator
            ->method('get')
            ->with('Config')
            ->will($this->returnValue(array(
                'enum' => array(
                    'options' => array(),
                ),
            )));

        $factory = new DoctrineOptionsFactory;
        $adapter = $factory->createService($serviceLocator);

        $this->assertInstanceOf(DoctrineOptions::class, $adapter);
    }
}
