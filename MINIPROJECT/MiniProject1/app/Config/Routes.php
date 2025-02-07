<?php

use App\Controllers\Pesanan;
use CodeIgniter\Router\RouteCollection;
use App\Controllers\Produk;

/**
 * @var RouteCollection $routes
 */

 /* Produk */
$routes->get('/', [Produk::class, 'index']);
$routes->get('/produk', [Produk::class, 'index']);
$routes->get('/produk/detail/(:segment)', [Produk::class, 'detail']);

$routes->get('/produk/create', [Produk::class, 'create']);
$routes->post('/produk/store', [Produk::class, 'store']);

$routes->get('/produk/edit/(:segment)', [Produk::class, 'edit']);
$routes->post('/produk/update/(:segment)', [Produk::class, 'update']);

$routes->get('/produk/delete/(:segment)', [Produk::class, 'delete']);

$routes->post('/produk/updateStock/(:segment)/(:any)', [Produk::class, 'updateStock']);

/* Pesanan */
$routes->get('/pesanan', [Pesanan::class, 'index']);
$routes->get('/pesanan/detail/(:segment)', [Pesanan::class, 'detail']);

$routes->get('/pesanan/create', [Pesanan::class, 'create']);
$routes->post('/pesanan/store', [Pesanan::class, 'store']);

$routes->get('/pesanan/edit/(:segment)', [Pesanan::class, 'edit']);
$routes->post('/pesanan/update/(:segment)', [Pesanan::class, 'update']);

$routes->get('/pesanan/delete/(:segment)', [Pesanan::class, 'delete']);