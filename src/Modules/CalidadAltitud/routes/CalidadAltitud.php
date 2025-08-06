<?php

use App\Middleware\AuthMiddleware;
use App\Middleware\RoleMiddleware;
use App\Modules\CalidadAltitud\Controllers\CalidadAltitudController;
use Slim\App;

return function (App $app) {

    $app->group('/calidadAlt', function ($group) {
        $group->get('', [CalidadAltitudController::class, 'index']);
        $group->post('', [CalidadAltitudController::class, 'store']);
        $group->put('/{id}', [CalidadAltitudController::class, 'update']);
        $group->delete('/{id}', [CalidadAltitudController::class, 'destroy']);
    })->add(new RoleMiddleware('admin'))
        ->add(new AuthMiddleware());
};
