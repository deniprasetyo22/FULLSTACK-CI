<?php

use App\Controllers\Mahasiswa;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', [Mahasiswa::class, 'index']);

$routes->get('/mahasiswa', [Mahasiswa::class, 'index']); // Menampilkan daftar mahasiswa
$routes->get('/mahasiswa/detail/(:any)', [Mahasiswa::class, 'detail/$1']); // Menampilkan detail mahasiswa berdasarkan NIM

$routes->get('/mahasiswa/create', [Mahasiswa::class, 'create']); // Form tambah mahasiswa
$routes->post('/mahasiswa/store', [Mahasiswa::class, 'store']); // Proses penyimpanan mahasiswa baru

$routes->get('/mahasiswa/update/(:any)', [Mahasiswa::class, 'update/$1']); // Form edit mahasiswa
$routes->post('/mahasiswa/saveUpdate', [Mahasiswa::class, 'saveUpdate']); // Proses update mahasiswa

$routes->get('/mahasiswa/delete/(:any)', [Mahasiswa::class, 'delete/$1']); // Menghapus mahasiswa berdasarkan NIM