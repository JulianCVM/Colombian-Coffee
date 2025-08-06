<?php

namespace App\Modules\Enfermedad\routes;

use App\Middleware\AuthMiddleware;
use App\Middleware\RoleMiddleware;
use App\Modules\Enfermedad\Controllers\EnfermedadController;
use Slim\App;

return function (App $app) {

    $app->group('/enfermedad', function ($group) {
        $group->get('', [EnfermedadController::class, 'index']);
        $group->post('', [EnfermedadController::class, 'store']);
        $group->put('/{id}', [EnfermedadController::class, 'update']);
        $group->delete('/{id}', [EnfermedadController::class, 'destroy']);
    })->add(new RoleMiddleware('admin'))
        ->add(new AuthMiddleware());
};
