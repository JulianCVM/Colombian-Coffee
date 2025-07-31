<?php

use App\Controllers\VariedadController;
use Slim\App;

// Enrutador para manejar los endpoints de variedad

return function (App $app) {
    // Se agrega al $app el group de /variedad donde se van a insertar todas las rutas de los endpoints a manejar para este modulo
    $app->group('/variedad', function ($group) {
        // Se implementa la primer ruta que hace referencia a 'index' el cual trae toda la data de variedad
        $group->get('', [VariedadController::class, 'index']);
        // Se implementa la ruta 'store' con la cual se van a crear variedades
        $group->post('', [VariedadController::class, 'store']);
    });
};
