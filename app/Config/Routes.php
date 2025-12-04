<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/admin/login', 'Admin\AuthController::login');
$routes->post('/admin/login', 'Admin\AuthController::loginPost');
$routes->get('/admin/logout', 'Admin\AuthController::logout');

$routes->get('/test', function() {
    return 'Route is working!';
});
$routes->get('/hello', 'TestController::hello');

$routes->get('/admin/dashboard', 'Admin\AdminController::dashboard');
$routes->group('admin/products', function($routes) {
    $routes->get('/', 'Admin\ProductController::index');
    $routes->get('create', 'Admin\ProductController::create');
    $routes->post('store', 'Admin\ProductController::store');
    $routes->get('edit/(:num)', 'Admin\ProductController::edit/$1');
    $routes->post('update/(:num)', 'Admin\ProductController::update/$1');
    $routes->get('delete/(:num)', 'Admin\ProductController::delete/$1');
    $routes->post('fieldShowHide', 'Admin\ProductController::fieldShowHide');
});

$routes->group('admin/adminusers', function($routes) {
    $routes->get('/', 'Admin\AdminuserController::index');
    $routes->get('create', 'Admin\AdminuserController::create');
    $routes->post('store', 'Admin\AdminuserController::store');
    $routes->get('edit/(:num)', 'Admin\AdminuserController::edit/$1');
    $routes->post('update/(:num)', 'Admin\AdminuserController::update/$1');
    $routes->get('delete/(:num)', 'Admin\AdminuserController::delete/$1');
    $routes->post('fieldShowHide', 'Admin\AdminuserController::fieldShowHide');
});

$routes->group('admin/qr_data', function($routes) {
    $routes->get('/', 'Admin\QrController::index');
    $routes->get('view/(:num)', 'Admin\QrController::view/$1');
    $routes->get('delete/(:num)', 'Admin\QrController::delete/$1');
    $routes->post('fieldShowHide', 'Admin\QrController::fieldShowHide');
});

$routes->get('/', 'Home::index');
$routes->get('qr/(:any)', 'QrCodeController::generate/$1');
$routes->get('qrRedirect/(:any)', 'QrCodeController::qrRedirect/$1');
$routes->post('getQr', 'QrCodeController::getQr/$1');

$routes->get('admin/media', 'Admin\MediaController::index');
$routes->get('admin/uploadMediaForm', 'Admin\MediaController::uploadForm');
$routes->post('admin/uploadMedia', 'Admin\MediaController::upload');
$routes->get('admin/json', 'Admin\MediaController::json');
$routes->post('admin/uploadAjax', 'Admin\MediaController::uploadAjax');
$routes->get('zipFind', 'ZipController::index');
$routes->post('process_excel', 'ZipController::process_excel');

$routes->group('admin/modules', function($routes) {
    $routes->get('/', 'Admin\ModuleController::index');
    $routes->get('create', 'Admin\ModuleController::create');
    $routes->post('store', 'Admin\ModuleController::store');
    $routes->get('edit/(:num)', 'Admin\ModuleController::edit/$1');
    $routes->post('update/(:num)', 'Admin\ModuleController::update/$1');
    $routes->get('delete/(:num)', 'Admin\ModuleController::delete/$1');
    $routes->post('fieldShowHide', 'Admin\ModuleController::fieldShowHide');
});

$routes->group('admin/scopes', function($routes) {
    $routes->get('/', 'Admin\ScopeController::index');
    $routes->get('create', 'Admin\ScopeController::create');
    $routes->post('store', 'Admin\ScopeController::store');
    $routes->get('edit/(:num)', 'Admin\ScopeController::edit/$1');
    $routes->post('update/(:num)', 'Admin\ScopeController::update/$1');
    $routes->get('delete/(:num)', 'Admin\ScopeController::delete/$1');
    $routes->post('fieldShowHide', 'Admin\ScopeController::fieldShowHide');
});