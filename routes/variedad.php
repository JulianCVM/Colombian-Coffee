<?php

use App\Controllers\VariedadController;
use Slim\App;
use App\Middleware\AuthMiddleware; // 👈 importa el middleware

return function (App $app) {
    // Grupo público (sin token)
    $app->group('/variedad', function ($group) {
        $group->get('', [VariedadController::class, 'index']);      // GET /variedad
        // Si quieres detalle: 
        // $group->get('/{id}', [VariedadController::class, 'show']); // GET /variedad/{id}
    });

    // Grupo protegido (requiere token admin)
    $app->group('/admin', function ($group) {
        // Ping para probar el middleware
        $group->get('/ping', function ($req, $res) {
            $auth = $req->getAttribute('auth');
            $res->getBody()->write(json_encode([
                'ok' => true,
                'whoami' => $auth
            ], JSON_UNESCAPED_UNICODE));
            return $res->withHeader('Content-Type', 'application/json');
        });

        // Aquí luego irá el CRUD protegido:
        // $group->post('/variedad', [VariedadController::class, 'store']);
        // $group->put('/variedad/{id}', [VariedadController::class, 'update']);
        // $group->delete('/variedad/{id}', [VariedadController::class, 'destroy']);
    })->add(new AuthMiddleware(['admin']));
};
