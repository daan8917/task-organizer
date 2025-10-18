<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Rutas para el organizador de tareas - TODAS CORREGIDAS
$routes->get('tasks', 'Tasks::index');
$routes->get('tasks/create', 'Tasks::create');
$routes->post('tasks/create', 'Tasks::create');
$routes->get('tasks/edit/(:num)', 'Tasks::edit/$1');
$routes->post('tasks/edit/(:num)', 'Tasks::edit/$1');
$routes->get('tasks/view/(:num)', 'Tasks::view/$1');
$routes->get('tasks/delete/(:num)', 'Tasks::delete/$1');
$routes->get('tasks/search', 'Tasks::search');
$routes->get('auth/login', 'Auth::login');
$routes->post('auth/login', 'Auth::login');
$routes->get('auth/logout', 'Auth::logout');

$routes->get('test-user', function() {
    $userModel = new \App\Models\UserModel();
    $user = $userModel->getUserByUsername('admin');
    
    if ($user) {
        return "Usuario encontrado: " . $user['username'] . " - Contraseña: " . $user['password'];
    } else {
        return "Usuario NO encontrado";
    }
});


