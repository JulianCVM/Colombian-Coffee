<?php

use App\Middleware\AuthMiddleware;
use App\Middleware\RoleMiddleware;
use App\Modules\Porte\Controllers\PorteController;
use Slim\App;

return function (App $app) {

    $app->group('/porte', function ($group) {
        $group->get('', [PorteController::class, 'index']);
        $group->post('', [PorteController::class, 'store']);
        $group->put('/{id}', [PorteController::class, 'update']);
        $group->delete('/{id}', [PorteController::class, 'destroy']);
    })->add(new RoleMiddleware('admin'))
        ->add(new AuthMiddleware());
};
