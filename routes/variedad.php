<?php

use App\Controllers\VariedadController;
use Slim\App;


return function (App $app) {
    // Grupo público (sin token)
    $app->group('/variedad', function ($group) {
        $group->get('', [VariedadController::class, 'index']);      // GET /variedad
        // Si quieres detalle: 
        // $group->get('/{id}', [VariedadController::class, 'show']); // GET /variedad/{id}
    });
};
