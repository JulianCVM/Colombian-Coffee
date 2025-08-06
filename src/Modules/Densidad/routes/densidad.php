<?php

namespace App\Modules\Densidad\routes;

use App\Middleware\AuthMiddleware;
use App\Middleware\RoleMiddleware;
use App\Modules\Densidad\Controllers\DensidadController;
use Slim\App;

return function (App $app) {

    $app->group('/densidad', function ($group) {
        $group->get('', [DensidadController::class, 'index']);
        $group->post('', [DensidadController::class, 'store']);
        $group->put('/{id}', [DensidadController::class, 'update']);
        $group->delete('/{id}', [DensidadController::class, 'destroy']);
    })->add(new RoleMiddleware('admin'))
        ->add(new AuthMiddleware());
};
