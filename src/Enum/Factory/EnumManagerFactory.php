<?php
namespace Enum\Factory;

use Enum\EnumManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class EnumManagerFactory implements FactoryInterface
{
    /**
     * @param  ServiceLocatorInterface $serviceLocator
     * @return EnumManager
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $adapter = $serviceLocator->get('Enum\Adapter\Adapter');
        return new EnumManager($adapter);
    }
}