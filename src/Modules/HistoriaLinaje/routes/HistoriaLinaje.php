<?php

use App\Middleware\AuthMiddleware;
use App\Middleware\RoleMiddleware;
use App\Modules\HistoriaLinaje\Controllers\HistoriaLinajeController;
use Slim\App;

return function (App $app) {

    $app->group('/HistoriaLinaje', function ($group) {
        $group->get('', [HistoriaLinajeController::class, 'index']);
        $group->post('', [HistoriaLinajeController::class, 'store']);
        $group->put('/{id}', [HistoriaLinajeController::class, 'update']);
        $group->delete('/{id}', [HistoriaLinajeController::class, 'destroy']);
    })->add(new RoleMiddleware('admin'))
        ->add(new AuthMiddleware());
};
