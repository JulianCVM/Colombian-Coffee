<?php

use App\Controllers\VariedadController;
use App\Middleware\AuthMiddleware;
use Slim\App;


# grupo de rutas protegidas dentro de una aplicación web utilizando el Slim
return function (App $app) {
    // Grupo protegido: requiere JWT válido
    $app->group('/variedad', function ($group) {
        $group->get('', [VariedadController::class, 'index']);
        // $group->get('/{id}', [VariedadController::class, 'show']);
    })->add(new AuthMiddleware(['admin', 'usuario']));
};

