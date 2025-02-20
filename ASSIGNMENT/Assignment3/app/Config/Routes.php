<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Student::index');
$routes->get('/student/(:segment)', 'Student::profile/$1');

$routes->get('/dashboard', 'Academic::index');
$routes->get('/student-list', 'Academic::studentList', ['as' => 'student-list']);
$routes->get('/student-profile/(:segment)', 'Academic::studentProfile/$1');
$routes->get('/course-list', 'Academic::courseList', ['as' => 'course-list']);