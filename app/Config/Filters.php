<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Filters extends BaseConfig
{
    public $aliases = [
        'auth' => \App\Filters\AuthFilter::class, // Filter untuk autentikasi
    ];

    public $filters = [
        'auth:admin' => ['before' => ['admin/*']], // Filter untuk route admin
        'auth:owner' => ['before' => ['owner/*']], // Filter untuk route owner
        'auth:customer' => ['before' => ['customer/*']], // Filter untuk route customer
    ];
}
