<?php

use App\Middleware\AuthMiddleware;
use App\Middleware\RoleMiddleware;
use App\Modules\DatosAgronomicos\Controllers\DatoAgroController;
use Slim\App;

return function (App $app) {

    $app->group('/datoAgro', function ($group) {
        $group->get('', [DatoAgroController::class, 'index']);
        $group->post('', [DatoAgroController::class, 'store']);
        $group->put('/{id}', [DatoAgroController::class, 'update']);
        $group->delete('/{id}', [DatoAgroController::class, 'destroy']);
    })->add(new RoleMiddleware('admin'))
        ->add(new AuthMiddleware());
};
