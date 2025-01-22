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
            // Terapkan filter auth untuk semua rute, kecuali yang dikecualikan
            'auth' => [
                'except' => [
                    '/',                // Halaman utama
                    'login',            // Halaman login
                    'auth/*',           // Semua rute terkait autentikasi
                    'register',         // Halaman register
                    'customer/*',       // Semua rute customer yang tidak membutuhkan autentikasi
                ],
            ],
        ],
        'after' => [
            'toolbar', // Tambahkan DebugToolbar setelah semua request
        ],
    ];

    public $methods = [];

    public $filters = [
        // Terapkan filter auth untuk admin dan owner
        'auth' => [
            'before' => [
                'admin/*',  // Semua rute dengan prefix admin
                'owner/*',  // Semua rute dengan prefix owner
            ],
        ],
    ];
}
