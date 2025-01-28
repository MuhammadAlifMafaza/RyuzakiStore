<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'CustomerController::index');

$routes->get('/login', 'AuthController::login');
$routes->post('/auth/loginProcess', 'AuthController::loginProcess');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/register', 'AuthController::register');
$routes->post('/register/process', 'AuthController::registerProcess');

// Kelompokkan rute untuk customer
$routes->group('', function ($routes) {
    $routes->get('/', 'CustomerController::index');
    $routes->get('checkout', 'CustomerController::checkout');
});

// Kelompokkan rute untuk admin
$routes->group('admin', function ($routes) {
    $routes->get('/', 'AdminController::index');
    $routes->get('dashboard', 'AdminController::dashboard');
    $routes->get('settings', 'AdminController::settings');
});

// Kelompokkan rute untuk owner
$routes->group('owner', function ($routes) {
    $routes->get('/', 'OwnerController::index');
    $routes->get('dashboard', 'OwnerController::dashboard');
    $routes->get('reports', 'OwnerController::reports');
});
