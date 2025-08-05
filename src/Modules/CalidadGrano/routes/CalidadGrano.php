<?php

use App\Modules\CalidadGrano\Controllers\CalidadGranoController;
use Slim\App;

return function (App $app) {

    $app->group('/calidadG', function ($group) {
        $group->get('', [CalidadGranoController::class, 'index']);
        $group->post('', [CalidadGranoController::class, 'store']);
        $group->put('/{id}', [CalidadGranoController::class, 'update']);
        $group->delete('/{id}', [CalidadGranoController::class, 'destroy']);
    });
};
