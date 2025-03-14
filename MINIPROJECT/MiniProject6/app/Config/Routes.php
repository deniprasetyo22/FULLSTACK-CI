<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/home', 'Product::index', ['as' => 'home']);
// $routes->get('product-detail/(:segment)', 'Product::productDetailForUser/$1', ['as' => 'product-detail']);
// $routes->get('user-list', 'User::userListForUser', ['as' => 'user-list']);
// $routes->get('user-detail/(:segment)', 'User::userDetailForUser/$1', ['as' => 'user-detail']);



/* Public Routes */
$routes->group('', ['namespace' => 'App\Controllers'], function($routes) {
    // Registrasi
    $routes->get('register', 'Auth::register', ['as' => 'register']);
    $routes->post('register', 'Auth::attemptRegister');
    
    // Route lain seperti login, dll
    $routes->get('/', 'Auth::login');
    $routes->get('login', 'Auth::login', ['as' => 'login']);
    $routes->post('login', 'Auth::attemptLogin');
});

/* All Roles Routes */
$routes->group('', ['filter' => 'role:administrator,product_manager,customer'], function($routes) {
    $routes->get('home', 'Product::index', ['as' => 'home']);
});

/* Admin Routes */
$routes->group('admin',['filter' => 'role:administrator'], function($routes) {
    $routes->get('admin-dashboard', 'Dashboard::adminDashboard', ['as' => 'admin-dashboard']);

    // $routes->group('user', function($routes) {
    //     $routes->get('/', 'User::index', ['as' => 'user']);
    //     $routes->get('profile/(:num)', 'User::profile/$1', ['as' => 'user_profile']);
    //     $routes->get('create', 'User::create', ['as' => 'create_user']);
    //     $routes->post('store', 'User::store', ['as' => 'store_user']);
    //     $routes->get('edit/(:segment)', 'User::edit/$1', ['as' => 'edit_user']);
    //     $routes->put('update/(:segment)', 'User::update/$1', ['as' => 'update_user']);
    //     $routes->delete('delete/(:segment)', 'User::delete/$1', ['as' => 'delete_user']);
    //     $routes->get('role/(:alphanum)', 'User::role/$1', ['as' => 'role_user']);
    // });

    $routes->group('auth', function ($routes) {
        $routes->get('/', 'AuthUser::index', ['as' => 'auth-user']);
        $routes->get('profile/(:segment)', 'AuthUser::profile/$1', ['as' => 'auth-user-profile']);
        $routes->get('create', 'AuthUser::create', ['as' => 'auth-create-user']);
        $routes->post('store', 'AuthUser::store', ['as' => 'auth-store-user']);
        $routes->get('edit/(:segment)', 'AuthUser::edit/$1', ['as' => 'auth-edit-user']);
        $routes->put('update/(:segment)', 'AuthUser::update/$1', ['as' => 'auth-update-user']);
        $routes->delete('delete/(:segment)', 'AuthUser::delete/$1', ['as' => 'auth-delete-user']);
        $routes->get('change-role/(:segment)', 'AuthUser::changeRole/$1', ['as' => 'auth-change-role']);
        $routes->put('update-role/(:segment)', 'AuthUser::updateRole/$1', ['as' => 'auth-update-role']);
    });

    $routes->group('role', function ($routes) {
        $routes->get('/', 'Role::index', ['as' => 'role']);
        $routes->get('create', 'Role::create', ['as' => 'create-role']);
        $routes->post('store', 'Role::store', ['as' => 'store-role']);
        $routes->get('edit/(:segment)', 'Role::edit/$1', ['as' => 'edit-role']);
        $routes->put('update/(:segment)', 'Role::update/$1', ['as' => 'update-role']);
        $routes->delete('delete/(:segment)', 'Role::delete/$1', ['as' => 'delete-role']);
    });
});

/* Admin and Manager Route */
$routes->group('', ['filter' => 'role:administrator,product_manager'], function ($routes) {
    $routes->group('product', function ($routes) {
        $routes->get('/', 'Product::indexAdmin', ['as' => 'product']);
        $routes->get('create', 'Product::create', ['as' => 'create_product']);
        $routes->post('store', 'Product::store', ['as' => 'store_product']);
        $routes->get('edit/(:segment)', 'Product::edit/$1', ['as' => 'edit_product']);
        $routes->put('update/(:segment)', 'Product::update/$1', ['as' => 'update_product']);
        $routes->delete('delete/(:segment)', 'Product::delete/$1', ['as' => 'delete_product']);
        $routes->get('detail/(:segment)', 'Product::show/$1', ['as' => 'product_detail']);
        $routes->get('productListForUser', 'Product::productListForUser', ['as' => 'productListForUser']);
    });
});

/* Product Manager Route */
$routes->group('manager', ['filter' => 'role:product_manager'], function ($routes) {
    $routes->get('manager-dashboard', 'Dashboard::managerDashboard', ['as' => 'manager-dashboard']);
});

/* User Routes */
$routes->group('user', ['filter' => 'role:customer'], function ($routes) {
    $routes->get('my-profile', 'User::myProfile', ['as' => 'my-profile']);
    $routes->get('edit-my-profile', 'User::editMyProfile', ['as' => 'edit-my-profile']);
    $routes->put('update-my-profile', 'User::updateMyProfile', ['as' => 'update-my-profile']);
});