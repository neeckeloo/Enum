<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'Enum\EnumManager'             => 'Enum\Factory\EnumManagerFactory',
            'Enum\Adapter\Adapter'         => 'Enum\Factory\AdapterFactory',
            'Enum\Adapter\DoctrineAdapter' => 'Enum\Factory\DoctrineAdapterFactory',
            'Enum\Options\DoctrineOptions' => 'Enum\Factory\DoctrineOptionsFactory',
        ),
    ),

    'view_helpers' => array(
        'invokables' => array(
            'Enum' => 'Enum\View\Helper\Enum',
        ),
    ),
);