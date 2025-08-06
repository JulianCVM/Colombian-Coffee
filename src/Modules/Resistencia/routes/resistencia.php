<?php

use App\Modules\Resistencia\Controllers\ResistenciaController;
use Slim\App;

return function (App $app) {

    $app->group('/resistencias', function ($group) {
        $group->get('', [ResistenciaController::class, 'index']);
        $group->post('', [ResistenciaController::class, 'store']);
        $group->put('/{id}', [ResistenciaController::class, 'update']);
        $group->delete('/{id}', [ResistenciaController::class, 'destroy']);
    });
};
