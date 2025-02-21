<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Product::productListForUser', ['as' => 'home']);
$routes->get('product-detail/(:segment)', 'Product::productDetailForUser/$1', ['as' => 'product-detail']);
$routes->get('user-list', 'User::userListForUser', ['as' => 'user-list']);
$routes->get('user-detail/(:segment)', 'User::userDetailForUser/$1', ['as' => 'user-detail']);

/* Admin Routes */
$routes->group('admin', function($routes) {
    $routes->get('dashboard', 'Admin::dashboard', ['as' => 'dashboard']);
});


/* User Routes */
$routes->group('user', function($routes) {
    $routes->get('/', 'User::index', ['as' => 'user']);
    $routes->get('profile/(:num)', 'User::profile/$1', ['as' => 'profile_user']);
    $routes->get('create', 'User::create', ['as' => 'create_user']);
    $routes->post('store', 'User::store', ['as' => 'store_user']);
    $routes->get('setting/(:alpha)', 'User::setting/$1', ['as' => 'setting_user']);
    $routes->post('update/(:segment)', 'User::update/$1', ['as' => 'update_user']);
    $routes->delete('delete/(:segment)', 'User::delete/$1', ['as' => 'delete_user']);
    $routes->get('role/(:alphanum)', 'User::role/$1', ['as' => 'role_user']);
});


/* Product Routes */
$routes->group('product', function($routes) {
    $routes->get('/', 'Product::index', ['as' => 'product']);
    $routes->get('create', 'Product::create', ['as' => 'create_product']);
    $routes->post('store', 'Product::store', ['as' => 'store_product']);
    $routes->get('edit/(:segment)', 'Product::edit/$1', ['as' => 'edit_product']);
    $routes->put('update/(:segment)', 'Product::update/$1', ['as' => 'update_product']);
    $routes->delete('delete/(:segment)', 'Product::delete/$1', ['as' => 'delete_product']);
    $routes->get('detail/(:segment)', 'Product::show/$1', ['as' => 'detail_product']);
    $routes->get('productListForUser', 'Product::productListForUser', ['as' => 'productListForUser']);
});