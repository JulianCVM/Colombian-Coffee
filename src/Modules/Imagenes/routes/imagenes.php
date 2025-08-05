<?php

namespace App\Modules\Imagenes\routes;

use App\Modules\Imagenes\Controllers\ImagenController;
use Slim\App;

// Enrutador para manejar los endpoints de variedad

return function (App $app) {
    $app->group('/imagenes', function ($group) {
        $group->get('', [ImagenController::class, 'index']);
        $group->post('', [ImagenController::class, 'store']);
        $group->put('/{id}', [ImagenController::class, 'update']);
        $group->delete('/{id}', [ImagenController::class, 'destroy']);
    });
};
