<?php

use App\Middleware\AuthMiddleware;
use App\Middleware\RoleMiddleware;
use App\Modules\Variedad\Controllers\VariedadController;
use Slim\App;

return function (App $app) {

    $app->group('/variedad', function ($group) {
        $group->get('', [VariedadController::class, 'index']);
        $group->post('', [VariedadController::class, 'store']);
        $group->put('/{id}', [VariedadController::class, 'update']);
        $group->delete('/{id}', [VariedadController::class, 'destroy']);
    })->add(new RoleMiddleware('admin'))
        ->add(new AuthMiddleware());
};
