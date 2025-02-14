<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index', ['filter' => 'auth']);
$routes->get('about', 'Home::about', ['as' => 'about']);
$routes->get('health-check', function () {
    return '<div>
        <h1>Server is running...</h1>
        <a href="/">Home</a>
        </div>';
});

// /* Produk Routes */
// $routes->group('produk', function($routes) {
//     $routes->get('/', 'Produk::index', ['as' => 'produk']);
//     $routes->get('detail/(:segment)', 'Produk::detail/$1', ['as' => 'detail_produk']);
//     $routes->get('create', 'Produk::create', ['as' => 'create_produk']);
//     $routes->post('store', 'Produk::store', ['as' => 'store_produk']);
//     $routes->get('edit/(:segment)', 'Produk::edit/$1', ['as' => 'edit_produk']);
//     $routes->put('update/(:segment)', 'Produk::update/$1', ['as' => 'update_produk']);
//     $routes->delete('delete/(:segment)', 'Produk::delete/$1', ['as' => 'delete_produk']);
//     $routes->post('updateStock/(:segment)/(:any)', 'Produk::updateStock/$1/$2', ['as' => 'updateStock_produk']);
// });

/* Produk Routes */
$routes->resource('produk', [
    'controller' => 'Produk',
    'only' => ['index', 'show', 'new', 'create', 'edit', 'update', 'delete'],
    'names' => [
        'index' => 'produk',
        'show' => 'detail_produk',
        'new' => 'create_produk',
        'create' => 'store_produk',
        'edit' => 'edit_produk',
        'update' => 'update_produk',
        'delete' => 'delete_produk'
    ]
]);

// Tambahkan route khusus untuk update stok
$routes->post('produk/updateStock/(:segment)/(:any)', 'Produk::updateStock/$1/$2', ['as' => 'updateStock_produk']);


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

// $routes->group('admin', ['filter' => 'auth'], function($routes) {
//     // Home Routes
//     $routes->get('/', 'Home::index');
//     $routes->get('about', 'Home::about', ['as' => 'about']);
//     $routes->get('health-check', function () {
//         return '<div>
//             <h1>Server is running...</h1>
//             <a href="/admin">Home</a>
//         </div>';
//     });

//     // Produk Routes (Resource)
//     $routes->resource('produk', [
//         'controller' => 'Produk',
//         'only' => ['index', 'show', 'new', 'create', 'edit', 'update', 'delete'],
//         'names' => [
//             'index' => 'produk',
//             'show' => 'detail_produk',
//             'new' => 'create_produk',
//             'create' => 'store_produk',
//             'edit' => 'edit_produk',
//             'update' => 'update_produk',
//             'delete' => 'delete_produk'
//         ]
//     ]);
//     // Route khusus untuk update stok
//     $routes->post('produk/updateStock/(:segment)/(:any)', 'Produk::updateStock/$1/$2', ['as' => 'updateStock_produk']);

//     // User Routes
//     $routes->group('user', function($routes) {
//         $routes->get('/', 'User::index', ['as' => 'user']);
//         $routes->get('profile/(:num)', 'User::profile/$1', ['as' => 'profile_user']);
//         $routes->get('create', 'User::create', ['as' => 'create_user']);
//         $routes->post('store', 'User::store', ['as' => 'store_user']);
//         $routes->get('setting/(:alpha)', 'User::setting/$1', ['as' => 'setting_user']);
//         $routes->post('update/(:segment)', 'User::update/$1', ['as' => 'update_user']);
//         $routes->delete('delete/(:segment)', 'User::delete/$1', ['as' => 'delete_user']);
//         $routes->get('role/(:alphanum)', 'User::role/$1', ['as' => 'role_user']);
//     });
// });


/* API Routes */
$routes->group('api', ['namespace' => 'App\\Controllers\\API'], function($routes) {
    $routes->get('/', 'UserAPI::index', ['as' => 'api']);
    
    // User Routes
    $routes->group('user', function($routes) {
        $routes->get('all', 'UserAPI::getAllUsers', ['as' => 'get_all_users']);
        $routes->get('/', 'UserAPI::getUserById', ['as' => 'get_user_by_id']);
    });

    // Product Routes
    $routes->group('product', function($routes) {
        $routes->get('all', 'ProdukAPI::getAllProduk', ['as' => 'get_all_products']);
        $routes->get('/', 'ProdukAPI::getProdukById', ['as' => 'get_product_by_id']);
    });
});



/* Error Routes */
$routes->set404Override(function() {
    return view('errors/custom_404');
});