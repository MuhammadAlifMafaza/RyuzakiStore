<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Filters extends BaseConfig
{
    public $aliases = [
        'csrf'     => \CodeIgniter\Filters\CSRF::class,
        'toolbar'  => \CodeIgniter\Filters\DebugToolbar::class,
        'honeypot' => \CodeIgniter\Filters\Honeypot::class,
        'auth'     => \App\Filters\AuthFilter::class, // Alias untuk AuthFilter
    ];

    public $globals = [
        'before' => [
            // Terapkan filter auth untuk semua rute kecuali login
            'auth' => ['except' => ['auth/*', '/', 'customer/*']],
        ],
        'after'  => [
            'toolbar',
        ],
    ];

    public $methods = [];

    public $filters = [
        // Terapkan filter untuk admin dan owner berdasarkan rute
        'auth' => ['before' => ['admin/*', 'owner/*']],
    ];
}
