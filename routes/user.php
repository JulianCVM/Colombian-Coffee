<?php

#Rutas para autenticación y administración de usuarios.
#Este archivo define las rutas para la autenticación de usuarios y administradores
#dentro del grupo '/auth'. Utiliza el framework Slim para manejar solicitudes HTTP POST
#relacionadas con acciones de registro e inicio de sesión

use App\Controllers\UserController;
use Slim\App;

return function (App $app) {
    $app->group('/auth', function ($group) {
        $group->post('/user/register', [UserController::class, 'createUser']);
        $group->post('/user/login', [UserController::class, 'loginUser']);

        $group->post('/admin/register', [UserController::class, 'createAdmin']);
        $group->post('/admin/login', [UserController::class, 'loginAdmin']);
    });
};
