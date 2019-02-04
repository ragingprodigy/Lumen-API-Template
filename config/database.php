<?php
declare(strict_types=1);

/**
 * Created by: dapo <o.omonayajo@gmail.com>
 * Created on: 06/07/2018, 5:59 PM
 */

return [
    'fetch' => PDO::FETCH_CLASS,
    'default' => env('DB_CONNECTION', 'default'),
    'connections' => [
        'default' => [
            'driver'    => env('DB_DRIVER', 'mysql'),
            'host'      => env('DB_HOST', 'database'),
            'port'      => env('DB_PORT', 3306),
            'database'  => env('DB_DATABASE', 'db'),
            'username'  => env('DB_USERNAME'),
            'password'  => env('DB_PASSWORD'),
            'charset'   => env('DB_CHARSET', 'utf8'),
            'prefix'    => '',
            'schema'    => 'public',
            'options' => [
                \PDO::ATTR_PERSISTENT => false
            ],
        ],
    ],
    'migrations' => 'migrations',
    'redis' => [
        'client' => 'predis',
        'default' => [
            'host'      => env('REDIS_HOST', 'redis'),
            'password'  => env('REDIS_PASSWORD', null),
            'port'      => env('REDIS_PORT', 6379),
            'database'  => 0,
        ],
    ],
];
