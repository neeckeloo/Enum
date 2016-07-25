<?php
namespace EnumTest\Factory;

use Enum\Adapter\AdapterInterface;
use Enum\Factory\AdapterFactory;
use Interop\Container\ContainerInterface;

class AdapterFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateService()
    {
        $container = $this->createMock(ContainerInterface::class);
        
        $container
            ->expects($this->at(0))
            ->method('get')
            ->with('Config')
            ->will($this->returnValue(array(
                'enum' => array(
                    'adapter' => 'Enum\Adapter\Adapter'
                ),
            )));

        $container
            ->expects($this->at(1))
            ->method('get')
            ->with('Enum\Adapter\Adapter')
            ->will($this->returnValue(
                $this->createMock(AdapterInterface::class)
            ));

        $factory = new AdapterFactory;
        $adapter = $factory($container);

        $this->assertInstanceOf(AdapterInterface::class, $adapter);
    }
}
