<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/home', 'Home::index');
$routes->get('/dashboard', 'Home::dashboard');
$routes->get('/products', 'Home::product');
$routes->get('/profile', 'Home::profile');
$routes->get('/latihanparser1', 'Home::latihanParser1');


/* Article Routes */
$routes->group('articles', function($routes) {
    $routes->get('/', 'Article::index');
    $routes->get('create', 'Article::create', ['as' => 'create_article']);
    $routes->post('store', 'Article::store', ['as' => 'store_article']);
    $routes->get('show/(:segment)', 'Article::show/$1', ['as' => 'show_article']);
    $routes->get('show/(:segment)', 'Article::show/$1', ['as' => 'show_article']);
    $routes->get('edit/(:segment)', 'Article::edit/$1', ['as' => 'edit_article']);
    $routes->put('update/(:segment)', 'Article::update/$1', ['as' => 'update_article']);
    $routes->delete('delete/(:segment)', 'Article::delete/$1', ['as' => 'delete_article']);
    $routes->get('table', 'Article::table', ['as' => 'table_article']);
    $routes->get('dynamic', 'Article::dynamic');
});

/* Error Routes */
$routes->set404Override(function() {
    return view('errors/custom_404');
});