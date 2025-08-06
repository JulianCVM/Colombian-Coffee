<?php

use App\Middleware\AuthMiddleware;
use App\Middleware\RoleMiddleware;
use App\Modules\VariedadGlobal\Controllers\VariedadGlobalController;
use Slim\App;

return function (App $app) {

    $app->group('/variedadGlobal', function ($group) {
        $group->get('/all', [VariedadGlobalController::class, 'index']);
    })->add(new RoleMiddleware('user'))
        ->add(new AuthMiddleware());
};
