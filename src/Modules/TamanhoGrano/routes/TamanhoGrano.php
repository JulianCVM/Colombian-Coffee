<?php

use App\Modules\TamanhoGrano\Controllers\TamanhoGranoController;
use Slim\App;

return function (App $app) {

    $app->group('/tamanho', function ($group) {
        $group->get('', [TamanhoGranoController::class, 'index']);
        $group->post('', [TamanhoGranoController::class, 'store']);
        $group->put('/{id}', [TamanhoGranoController::class, 'update']);
        $group->delete('/{id}', [TamanhoGranoController::class, 'destroy']);
    });
};
