<?php

use App\Controllers\Mahasiswa;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', '\App\Controllers\Mahasiswa\Mahasiswa::index');

// $routes->get('/mahasiswa', 'Mahasiswa::index');
// $routes->get('/mahasiswa/detail/(:any)', [Mahasiswa::class, 'detail/$1']);

// $routes->get('/mahasiswa/create', [Mahasiswa::class, 'create']);
// $routes->post('/mahasiswa/store', [Mahasiswa::class, 'store']);

// $routes->get('/mahasiswa/update/(:any)', 'Mahasiswa::update/$1');
// $routes->put('/mahasiswa/saveUpdate/(:any)', 'Mahasiswa::saveUpdate/$1');

// $routes->delete('/mahasiswa/delete/(:any)', 'Mahasiswa::delete/$1');

/* Routing Menggunakan Match */
$routes->match(['GET', 'POST'],'/mahasiswa/create', '\App\Controllers\Mahasiswa\Mahasiswa::feature');

/* Routing Menggunakan (:num) */
// $routes->get('/mahasiswa/detail/(:num)', '\App\Controllers\Mahasiswa\Mahasiswa::detail/$1');

/* Routing Menggunakan double segment */
$routes->get('/news/(:num)/(:alpha)', '\App\Controllers\Mahasiswa\Mahasiswa::show/$1/$2');

/* Routing Menggunakan (:alphanum) */
$routes->get('/profile/(:alphanum)', '\App\Controllers\Mahasiswa\Mahasiswa::profile/$1');

/* Routing Menggunakan (:segment) */
$routes->get('/products/(:segment)','\App\Controllers\Mahasiswa\Mahasiswa::products/$1');

/* Routing Menggunakan (:any) */
$routes->get('/article/(:any)','\App\Controllers\Mahasiswa\Mahasiswa::article/$1');

/* Route Group */
$routes->group('mahasiswa', function (RouteCollection $routes) {
    $routes->get('update/(:num)', '\App\Controllers\Mahasiswa\Mahasiswa::update/$1');
    $routes->put('saveUpdate/(:num)', '\App\Controllers\Mahasiswa\Mahasiswa::saveUpdate/$1');
    $routes->delete('delete/(:num)', '\App\Controllers\Mahasiswa\Mahasiswa::delete/$1');
});

/* Named Route */
$routes->get('/mahasiswa/detail/(:num)', '\App\Controllers\Mahasiswa\Mahasiswa::detail/$1', ['as'=> 'user_detail']);

/* Resource Routes(RESTful) */
// $routes->resource('photos'); //Without Folder
$routes->resource('photos', ['controller' => 'Photos\Photos']); //With Folder
/* Isi Resource Routes */
// Ini akan membuat route berikut:
// GET     /photos           -> index
// GET     /photos/new       -> new
// POST    /photos          -> create
// GET     /photos/(:any)   -> show
// GET     /photos/(:any)/edit -> edit
// PUT     /photos/(:any)   -> update
// DELETE  /photos/(:any)   -> delete

/* Resource Routes(RESTful) With Group */

/* Custom Error Page */
$routes->set404Override(static function(){
    return view('errors/error404');
});

/* Helper */
$routes->get('/price', '\App\Controllers\Mahasiswa\Mahasiswa::price');