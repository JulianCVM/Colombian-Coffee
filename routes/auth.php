<?php

use App\Controllers\UserController;
use App\Infraestructure\Repositories\UserRepository;
use Slim\App;

return function (App $app) {
    
    // Ruta de login - POST /auth/user/login
    $app->post('/auth/user/login', function ($request, $response) {
        $repo = new UserRepository();
        $controller = new UserController($repo);
        return $controller->loginUser($request, $response);
    });
    
    // Ruta de registro de usuario - POST /auth/user/register
    $app->post('/auth/user/register', function ($request, $response) {
        $repo = new UserRepository();
        $controller = new UserController($repo);
        return $controller->createUser($request, $response);
    });
    
    // Ruta de registro de admin - POST /auth/admin/register
    $app->post('/auth/admin/register', function ($request, $response) {
        $repo = new UserRepository();
        $controller = new UserController($repo);
        return $controller->createAdmin($request, $response);
    });
};