<?php
namespace Enum;

use Zend\Loader\StandardAutoloader;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            StandardAutoloader::class => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'initializers' => array(
                function($instance, $sm) {
                    if ($instance instanceof EnumManagerAwareInterface) {
                        $instance->setEnumManager($sm->get(EnumManager::class));
                    }
                },
            ),
        );
    }
}