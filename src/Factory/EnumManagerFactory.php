<?php
namespace Enum\Factory;

use Enum\EnumManager;
use Interop\Container\ContainerInterface;

class EnumManagerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $adapter = $container->get('Enum\Adapter\Adapter');

        return new EnumManager($adapter);
    }
}
