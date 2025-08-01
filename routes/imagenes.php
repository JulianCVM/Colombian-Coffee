<?php

use App\Controllers\ImagenController;
use Slim\App;

// Enrutador para manejar los endpoints de variedad

return function (App $app) {
    $app->group('/imagenes/{id}', function ($group) {
        $group->get('', [ImagenController::class, 'obtenerImagen']);
    });
};
