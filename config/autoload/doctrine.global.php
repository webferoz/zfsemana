<?php
return array(
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                    'params' => array(
                        'host' => 'zfsemana-db.my.phpcloud.com',
                        'dbname' => 'zfsemana',
                ),
            ),
        )
));