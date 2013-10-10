<?php
return array(
    'enum' => array(
        'adapter' => 'Enum\Adapter\DoctrineAdapter',
        'options' => array(
            'connection' => 'doctrine.connection.orm_default',
            'enum_table_name' => 'enumeration',
            'enum_item_table_name' => 'enumeration_item',
        ),
    ),
);