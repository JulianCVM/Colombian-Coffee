<?php

namespace App\Modules\Densidad\routes;

use App\Modules\Densidad\Controllers\DensidadController;
use Slim\App;

return function (App $app) {

    $app->group('/densidad', function ($group) {
        $group->get('', [DensidadController::class, 'index']);
        $group->post('', [DensidadController::class, 'store']);
        $group->put('/{id}', [DensidadController::class, 'update']);
        $group->delete('/{id}', [DensidadController::class, 'destroy']);
    });
};
