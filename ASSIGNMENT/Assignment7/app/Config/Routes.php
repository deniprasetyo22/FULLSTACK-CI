<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
// $routes->get('/', 'Student::index');
// $routes->get('/student/(:segment)', 'Student::profile/$1');
// $routes->get('/read','Student::read');

// $routes->get('/dashboard', 'Admin::index');

// $routes->get('/student-list', 'Student::studentList', ['as' => 'student-list']);
// $routes->get('/student-profile/(:segment)', 'Student::studentProfile/$1', ['as' => 'student-profile']);
// $routes->get('/create-student', 'Student::createStudent', ['as' => 'create-student']);
// $routes->post('/store-student', 'Student::storeStudent', ['as' => 'store-student']);
// $routes->delete('/delete-student/(:num)', 'Student::deleteStudent/$1', ['as' => 'delete-student']);
// $routes->get('/edit-student/(:num)', 'Student::editStudent/$1', ['as' => 'edit-student']);
// $routes->post('/update-student/(:num)', 'Student::updateStudent/$1', ['as' => 'update-student']);

// $routes->get('/course-list', 'Course::courseList', ['as' => 'course-list']);
// $routes->get('/course-detail/(:segment)', 'Course::courseDetail/$1', ['as' => 'course-detail']);
// $routes->get('/create-course', 'Course::createCourse', ['as' => 'create-course']);
// $routes->post('/store-course', 'Course::storeCourse', ['as' => 'store-course']);
// $routes->delete('/delete-course/(:num)', 'Course::deleteCourse/$1', ['as' => 'delete-course']);
// $routes->get('/edit-course/(:num)', 'Course::editCourse/$1', ['as' => 'edit-course']);
// $routes->put('/update-course/(:num)', 'Course::updateCourse/$1', ['as' => 'update-course']);


$routes->get('/', 'Auth::login');

$routes->group('', ['namespace' => 'App\Controllers'], function($routes) {
    // Registrasi
    $routes->get('register', 'Auth::register', ['as' => 'register']);
    $routes->post('register', 'Auth::attemptRegister');
    
    // Route lain seperti login, dll
    $routes->get('login', 'Auth::login', ['as' => 'login']);
    $routes->post('login', 'Auth::attemptLogin');

    // Test Send Email
    $routes->get('send-email', 'Auth::sendEmail');

    // Test Upload File
    $routes->get('upload-form', 'Auth::uploadForm');
    $routes->post('upload', 'Auth::upload');
});

// Routes yang hanya bisa diakses admin
$routes->group('admin', ['filter' => 'role:admin'], function($routes) {
    $routes->get('dashboard', 'Dashboard::adminDashboard');
    $routes->get('manage-users', 'Auth::manageUsers');   
    $routes->get('manage-roles', 'Auth::manageRoles');     
    
    $routes->get('student-list', 'Student::studentList', ['as' => 'student-list']);
    $routes->get('student-profile/(:segment)', 'Student::studentProfile/$1', ['as' => 'student-profile']);
    $routes->get('create-student', 'Student::createStudent', ['as' => 'create-student']);
    $routes->post('store-student', 'Student::storeStudent', ['as' => 'store-student']);
    $routes->delete('delete-student/(:num)', 'Student::deleteStudent/$1', ['as' => 'delete-student']);
    $routes->get('edit-student/(:num)', 'Student::editStudent/$1', ['as' => 'edit-student']);
    $routes->post('update-student/(:num)', 'Student::updateStudent/$1', ['as' => 'update-student']);

    $routes->get('enrollment', 'Enrollment::index');
    $routes->get('create-enrollment', 'Enrollment::create');
    $routes->post('store-enrollment', 'Enrollment::store');
    $routes->get('edit-enrollment/(:num)', 'Enrollment::edit/$1');
    $routes->put('update-enrollment/(:num)', 'Enrollment::update/$1');
    $routes->delete('delete-enrollment/(:num)', 'Enrollment::delete/$1');

    $routes->group('users', function ($routes) {
        $routes->get('/', 'Users::index');
        $routes->get('create', 'Users::create');
        $routes->post('store', 'Users::store');
        $routes->get('edit/(:num)', 'Users::edit/$1');
        $routes->put('update/(:num)', 'Users::update/$1'); 
        $routes->delete('delete/(:num)', 'Users::delete/$1');
    });
});

// Routes yang hanya bisa diakses lecturer
$routes->group('lecturer', ['filter' => 'role:lecturer'], function($routes) {
    $routes->get('dashboard', 'Dashboard::lecturerDashboard');
    $routes->get('manage-courses', 'Course::courseList');
});

// Routes yang hanya bisa diakses student
$routes->group('student', ['filter' => 'role:student'], function($routes) {
    $routes->get('dashboard', 'Dashboard::studentDashboard');
    $routes->get('enrollment', 'Student::enrollment');
    $routes->get('grades', 'Student::grades');
    $routes->get('profile', 'Student::profile');
    $routes->get('edit-my-profile', 'Student::editMyProfile');
    $routes->put('update-my-profile/(:num)', 'Student::updateMyProfile/$1');
    $routes->get('file/(:any)', 'Student::file/$1');

    $routes->group('enrollment', function ($routes) {
        $routes->get('my-enrollments', 'Enrollment::myEnrollments');
        $routes->get('create-enrollment', 'Enrollment::createMyEnrollment');
        $routes->post('store-enrollment', 'Enrollment::storeMyEnrollment');
        $routes->get('edit-enrollment/(:num)', 'Enrollment::edit/$1');
        $routes->put('update-enrollment/(:num)', 'Enrollment::update/$1');
        $routes->delete('delete-enrollment/(:num)', 'Enrollment::delete/$1');
    });
});

 // Routes yang bisa diakses oleh lecturer dan admin
$routes->group('', ['filter' => 'role:admin,lecturer'], function($routes) {
    $routes->get('reports', 'Report::index');
    $routes->get('generate-report', 'Report::generate');

    $routes->get('course-list', 'Course::courseList', ['as' => 'course-list']);
    $routes->get('course-detail/(:segment)', 'Course::courseDetail/$1', ['as' => 'course-detail']);
    $routes->get('create-course', 'Course::createCourse', ['as' => 'create-course']);
    $routes->post('store-course', 'Course::storeCourse', ['as' => 'store-course']);
    $routes->delete('delete-course/(:num)', 'Course::deleteCourse/$1', ['as' => 'delete-course']);
    $routes->get('edit-course/(:num)', 'Course::editCourse/$1', ['as' => 'edit-course']);
    $routes->put('update-course/(:num)', 'Course::updateCourse/$1', ['as' => 'update-course']);
});

// Route unauthorized
$routes->get('unauthorized', 'Home::unauthorized');