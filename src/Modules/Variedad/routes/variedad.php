<?php

use App\Modules\Variedad\Controllers\VariedadController;
use App\Modules\VariedadGlobal\Controllers\VariedadGlobalController;
use Slim\App;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function (App $app) {

    // RUTA DE EMERGENCIA - SIN DEPENDENCIAS
    $app->get('/test-emergency', function (Request $request, Response $response) {
        error_log("=== TEST EMERGENCY FUNCIONANDO ===");
        $data = ['status' => 'emergency works', 'timestamp' => date('Y-m-d H:i:s')];
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->group('/variedad', function ($group) {
        $group->get('', [VariedadController::class, 'index']);
        $group->post('', [VariedadController::class, 'store']);
        $group->get('/all', [VariedadGlobalController::class, 'index']);
        $group->put('/{id}', [VariedadController::class, 'update']);
        $group->delete('/{id}', [VariedadController::class, 'destroy']);
    });
};
