<?php

# REQUIRE THE BOOTSTRAP FILE
require_once "../app/init.php";

// Start our session
session_start();

# INITIALIZE THE CORE LIBRARY
$route_registerer = new App\Core\Router;

# INITIALIZE ROUTES

// Page routes
$route_registerer->addAllowedRoute('', ['controller' => 'Pages', 'action' => 'index']);
$route_registerer->addAllowedRoute('about', ['controller' => 'Pages', 'action' => 'about']);

// User routes
$route_registerer->addAllowedRoute('users/register', ['controller' => 'Users', 'action' => 'register']);
$route_registerer->addAllowedRoute('users/login', ['controller' => 'Users', 'action' => 'login']);
$route_registerer->addAllowedRoute('users/logout', ['controller' => 'Users', 'action' => 'logout']);

// Post routes
$route_registerer->addAllowedRoute('posts', ['controller' => 'Posts', 'action' => 'index']);
$route_registerer->addAllowedRoute('posts/add', ['controller' => 'Posts', 'action' => 'add']);
$route_registerer->addAllowedRoute('posts/add/{id:\d+}', ['controller' => 'Posts', 'action' => 'add']);
$route_registerer->addAllowedRoute('posts/edit/{id:\d+}', ['controller' => 'Posts', 'action' => 'edit']);
$route_registerer->addAllowedRoute('posts/show/{id:\d+}', ['controller' => 'Posts', 'action' => 'show']);
$route_registerer->addAllowedRoute('posts/delete/{id:\d+}', ['controller' => 'Posts', 'action' => 'delete']);

# CALL OUR DISPATCHER
$route_registerer->dispatch();
