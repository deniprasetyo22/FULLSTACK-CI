<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Hello;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('hello', [Hello::class, 'index']);
$routes->get('hello/model', [Hello::class, 'hello_model']);
$routes->get('hello/view', [Hello::class, 'hello_view']);
$routes->get('hello/mvc', [Hello::class, 'hello_mvc']);