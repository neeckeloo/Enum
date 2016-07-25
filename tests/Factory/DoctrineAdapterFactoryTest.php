<?php
namespace EnumTest\Factory;

use Doctrine\DBAL\Connection;
use Enum\Adapter\DoctrineAdapter;
use Enum\Factory\DoctrineAdapterFactory;
use Enum\Options\DoctrineOptions;
use Interop\Container\ContainerInterface;

class DoctrineAdapterFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateService()
    {
        $container = $this->createMock(ContainerInterface::class);

        $options = $this->createMock(DoctrineOptions::class);
        $options
            ->method('getConnection')
            ->will($this->returnValue('connection'));

        $container
            ->expects($this->at(0))
            ->method('get')
            ->with(DoctrineOptions::class)
            ->will($this->returnValue($options));

        $connection = $this->getMockBuilder(Connection::class)
            ->disableOriginalConstructor()
            ->getMock();

        $container
            ->expects($this->at(1))
            ->method('get')
            ->with('connection')
            ->will($this->returnValue($connection));

        $factory = new DoctrineAdapterFactory;
        $adapter = $factory($container);

        $this->assertInstanceOf(DoctrineAdapter::class, $adapter);
    }
}
