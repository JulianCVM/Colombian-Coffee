<?php

use App\Middleware\AuthMiddleware;
use App\Middleware\RoleMiddleware;
use App\Modules\PotencialDeRendimiento\Controllers\PotencialDeRendimientoController;
use Slim\App;

return function (App $app) {

    $app->group('/potencial', function ($group) {
        $group->get('', [PotencialDeRendimientoController::class, 'index']);
        $group->post('', [PotencialDeRendimientoController::class, 'store']);
        $group->put('/{id}', [PotencialDeRendimientoController::class, 'update']);
        $group->delete('/{id}', [PotencialDeRendimientoController::class, 'destroy']);
    })->add(new RoleMiddleware('admin'))
        ->add(new AuthMiddleware());
};
