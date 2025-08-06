<?php

use App\Modules\Variedad\Controllers\VariedadController;
use App\Modules\VariedadGlobal\Controllers\VariedadGlobalController;
use Slim\App;

return function (App $app) {

    $app->group('/variedad', function ($group) {
        $group->get('', [VariedadController::class, 'index']);
        $group->post('', [VariedadController::class, 'store']);
        $group->get('/all', [VariedadGlobalController::class, 'index']);
        $group->put('/{id}', [VariedadController::class, 'update']);
        $group->delete('/{id}', [VariedadController::class, 'destroy']);
    });
};
