<?php
namespace EnumTest\Factory;

use Enum\Factory\DoctrineAdapterFactory;

class DoctrineAdapterFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateService()
    {
        $serviceLocator = $this->getMock('Zend\ServiceManager\ServiceLocatorInterface');

        $options = $this->getMock('Enum\Options\DoctrineOptions');
        $options
            ->expects($this->once())
            ->method('getConnection')
            ->will($this->returnValue('connection'));

        $serviceLocator
            ->expects($this->at(0))
            ->method('get')
            ->with('Enum\Options\DoctrineOptions')
            ->will($this->returnValue($options));

        $connection = $this->getMockBuilder('Doctrine\DBAL\Connection')
                        ->disableOriginalConstructor()
                        ->getMock();

        $serviceLocator
            ->expects($this->at(1))
            ->method('get')
            ->with('connection')
            ->will($this->returnValue($connection));

        $factory = new DoctrineAdapterFactory;
        $adapter = $factory->createService($serviceLocator);

        $this->assertInstanceOf('Enum\Adapter\DoctrineAdapter', $adapter);
    }
}