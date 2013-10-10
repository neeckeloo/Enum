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
        $manager = new EnumManager();

        $entityManager = $serviceLocator->get('Doctrine\ORM\EntityManager');
        $manager->setEntityManager($entityManager);

        return $manager;
    }
}