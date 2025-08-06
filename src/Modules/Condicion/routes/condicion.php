<?php

use App\Middleware\AuthMiddleware;
use App\Middleware\RoleMiddleware;
use App\Modules\Condicion\Controllers\CondicionController;
use Slim\App;

return function (App $app) {

    $app->group('/condicion', function ($group) {
        $group->get('', [CondicionController::class, 'index']);
        $group->post('', [CondicionController::class, 'store']);
        $group->put('/{id}', [CondicionController::class, 'update']);
        $group->delete('/{id}', [CondicionController::class, 'destroy']);
    })->add(new RoleMiddleware('admin'))
        ->add(new AuthMiddleware());
};
