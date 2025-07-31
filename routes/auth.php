<?php


// configuración de rutas para manejar solicitudes HTTP relacionadas con autenticación.
use Slim\App;
use App\Controllers\UserController;

return function (App $app) {
    $app->post('/auth/user/login', function ($req, $res) {
        $res->getBody()->write(json_encode(['msg' => 'Funciona login']));
        return $res->withHeader('Content-Type', 'application/json');
    });
};



// FALTA ARREGLAR 
#use Slim\App;
#use App\Controllers\UserController;
#
#return function (App $app) {
#    $app->group('/auth', function ($group) {
#        $group->post('/user/login', [UserController::class, 'login']);
#        $group->post('/user/register', [UserController::class, 'createUser']);
#    });
#};
