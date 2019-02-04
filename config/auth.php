<?php
declare(strict_types=1);

/**
 * Created by: dapo <o.omonayajo@gmail.com>
 * Created on: 29/01/2019, 4:06 PM
 */
 return [
     'defaults' => [
         'guard' => 'api',
     ],

     'guards' => [
         'api' => [
             'driver'    => 'jwt',
             'provider'  => 'users'
         ],
     ],

     'providers' => [
         'users' => [
             'driver' => 'eloquent',
             'model'  => \DevProject\Eloquent\Models\User::class,
         ],
     ],
 ];
