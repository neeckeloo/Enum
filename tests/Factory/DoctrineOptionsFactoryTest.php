<?php
namespace EnumTest\Factory;

use Enum\Factory\DoctrineOptionsFactory;
use Enum\Options\DoctrineOptions;
use Interop\Container\ContainerInterface;

class DoctrineOptionsFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateService()
    {
        $container = $this->createMock(ContainerInterface::class);

        $container
            ->method('get')
            ->with('Config')
            ->will($this->returnValue(array(
                'enum' => array(
                    'options' => array(),
                ),
            )));

        $factory = new DoctrineOptionsFactory;
        $adapter = $factory($container);

        $this->assertInstanceOf(DoctrineOptions::class, $adapter);
    }
}
