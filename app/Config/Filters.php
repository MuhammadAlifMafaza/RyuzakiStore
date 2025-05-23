<?php

namespace Config;

use CodeIgniter\Config\Filters as BaseFilters;
use CodeIgniter\Filters\Cors;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\ForceHTTPS;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\PageCache;
use CodeIgniter\Filters\PerformanceMetrics;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseFilters
{
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'cors'          => Cors::class,
        'forcehttps'    => ForceHTTPS::class,
        'pagecache'     => PageCache::class,
        'performance'   => PerformanceMetrics::class,
        'admin'         => \App\Filters\AdminFilter::class,
        'owner'         => \App\Filters\OwnerFilter::class,
        'auth'          => \App\Filters\AuthFilter::class,
        // 'authfilter' => \App\Filters\AuthFilter::class,
    ];

    public array $required = [
        'before' => [
            'forcehttps', // Force Global Secure Requests
            'pagecache',  // Web Page Caching
        ],
        'after' => [
            'pagecache',   // Web Page Caching
            'performance', // Performance Metrics
            'toolbar',     // Debug Toolbar
        ],
    ];

    public array $globals = [
        'before' => [
            // 'honeypot',
            // 'csrf',
            // 'invalidchars',

        ],
        'after' => [
            // 'honeypot',
            // 'secureheaders',
            'toolbar',
        ],
    ];

    public array $methods = [];

    public array $filters = [
        'admin' => ['except' => ['admin/*']], // Menetapkan filter admin hanya pada grup 'admin/*'
        'owner' => ['except' => ['owner/*']], // Menetapkan filter owner hanya pada grup 'owner/*'
    ];
}
