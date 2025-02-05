<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Mahasiswa::index');

$routes->get('/mahasiswa', 'Mahasiswa::index'); // Menampilkan daftar mahasiswa
$routes->get('/mahasiswa/detail/(:num)', 'Mahasiswa::detail/$1'); // Menampilkan detail mahasiswa berdasarkan NIM

$routes->get('/mahasiswa/create', 'Mahasiswa::create'); // Form tambah mahasiswa
$routes->post('/mahasiswa/store', 'Mahasiswa::store'); // Proses penyimpanan mahasiswa baru

$routes->get('/mahasiswa/update/(:num)', 'Mahasiswa::update/$1'); // Form edit mahasiswa
$routes->post('/mahasiswa/saveUpdate', 'Mahasiswa::saveUpdate'); // Proses update mahasiswa

$routes->get('/mahasiswa/delete/(:num)', 'Mahasiswa::delete/$1'); // Menghapus mahasiswa berdasarkan NIM