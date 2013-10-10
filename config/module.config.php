<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'Enum\EnumManager' => 'Enum\Service\EnumManagerFactory',
        ),
    ),

    'view_helpers' => array(
        'invokables' => array(
            'Enum' => 'Enum\View\Helper\Enum',
        ),
    ),
);