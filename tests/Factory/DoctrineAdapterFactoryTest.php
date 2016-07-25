<?php
namespace EnumTest\Factory;

use Doctrine\DBAL\Connection;
use Enum\Adapter\DoctrineAdapter;
use Enum\Factory\DoctrineAdapterFactory;
use Enum\Options\DoctrineOptions;
use Zend\ServiceManager\ServiceLocatorInterface;

class DoctrineAdapterFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateService()
    {
        $serviceLocator = $this->createMock(ServiceLocatorInterface::class);

        $options = $this->createMock(DoctrineOptions::class);
        $options
            ->method('getConnection')
            ->will($this->returnValue('connection'));

        $serviceLocator
            ->expects($this->at(0))
            ->method('get')
            ->with(DoctrineOptions::class)
            ->will($this->returnValue($options));

        $connection = $this->getMockBuilder(Connection::class)
                        ->disableOriginalConstructor()
                        ->getMock();

        $serviceLocator
            ->expects($this->at(1))
            ->method('get')
            ->with('connection')
            ->will($this->returnValue($connection));

        $factory = new DoctrineAdapterFactory;
        $adapter = $factory->createService($serviceLocator);

        $this->assertInstanceOf(DoctrineAdapter::class, $adapter);
    }
}
