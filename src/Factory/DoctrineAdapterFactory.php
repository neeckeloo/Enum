<?php
namespace Enum\Factory;

use Enum\Adapter\DoctrineAdapter;
use Enum\Options\DoctrineOptions;
use Interop\Container\ContainerInterface;

class DoctrineAdapterFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $options    = $container->get(DoctrineOptions::class);
        $connection = $container->get($options->getConnection());

        return new DoctrineAdapter($connection, $options);
    }
}
