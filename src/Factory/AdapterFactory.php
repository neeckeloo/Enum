<?php
namespace Enum\Factory;

use Interop\Container\ContainerInterface;

class AdapterFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('Config');

        return $container->get($config['enum']['adapter']);
    }
}
