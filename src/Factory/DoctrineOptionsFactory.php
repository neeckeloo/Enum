<?php
namespace Enum\Factory;

use Enum\Options\DoctrineOptions;
use Interop\Container\ContainerInterface;

class DoctrineOptionsFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('Config');

        return new DoctrineOptions($config['enum']['options']);
    }
}
