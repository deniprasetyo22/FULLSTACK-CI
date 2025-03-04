<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/', 'Student::index');
$routes->get('/student/(:segment)', 'Student::profile/$1');
$routes->get('/read','Student::read');

$routes->get('/dashboard', 'Admin::index');

$routes->get('/student-list', 'Student::studentList', ['as' => 'student-list']);
$routes->get('/student-profile/(:segment)', 'Student::studentProfile/$1', ['as' => 'student-profile']);
$routes->get('/create-student', 'Student::createStudent', ['as' => 'create-student']);
$routes->post('/store-student', 'Student::storeStudent', ['as' => 'store-student']);
$routes->delete('/delete-student/(:num)', 'Student::deleteStudent/$1', ['as' => 'delete-student']);
$routes->get('/edit-student/(:num)', 'Student::editStudent/$1', ['as' => 'edit-student']);
$routes->post('/update-student/(:num)', 'Student::updateStudent/$1', ['as' => 'update-student']);

$routes->get('/course-list', 'Course::courseList', ['as' => 'course-list']);
$routes->get('/course-detail/(:segment)', 'Course::courseDetail/$1', ['as' => 'course-detail']);
$routes->get('/create-course', 'Course::createCourse', ['as' => 'create-course']);
$routes->post('/store-course', 'Course::storeCourse', ['as' => 'store-course']);
$routes->delete('/delete-course/(:num)', 'Course::deleteCourse/$1', ['as' => 'delete-course']);
$routes->get('/edit-course/(:num)', 'Course::editCourse/$1', ['as' => 'edit-course']);
$routes->put('/update-course/(:num)', 'Course::updateCourse/$1', ['as' => 'update-course']);