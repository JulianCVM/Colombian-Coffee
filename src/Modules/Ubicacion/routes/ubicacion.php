<?php

use App\Middleware\AuthMiddleware;
use App\Middleware\RoleMiddleware;
use App\Modules\Ubicacion\Controllers\UbicacionController;
use Slim\App;

return function (App $app) {

    $app->group('/ubicacion', function ($group) {
        $group->get('', [UbicacionController::class, 'index']);
        $group->post('', [UbicacionController::class, 'store']);
        $group->put('/{id}', [UbicacionController::class, 'update']);
        $group->delete('/{id}', [UbicacionController::class, 'destroy']);
    })->add(new RoleMiddleware('admin'))
        ->add(new AuthMiddleware());
};
