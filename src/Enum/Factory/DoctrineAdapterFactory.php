<?php
namespace Enum\Factory;

use Enum\Adapter\DoctrineAdapter;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DoctrineAdapterFactory implements FactoryInterface
{
    /**
     * @param  ServiceLocatorInterface $serviceLocator
     * @return DoctrineAdapter
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = $serviceLocator->get('Enum\Options\DoctrineOptions');

        $connection = $serviceLocator->get($options->getConnection());
        $tableName  = $options->getTableName();

        return new DoctrineAdapter($connection, $tableName);
    }
}