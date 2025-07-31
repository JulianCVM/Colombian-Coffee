<?php

use App\Controllers\UserController;
use Slim\App;

return function (App $app) {
    $app->group('/auth', function ($group) {
        $group->post('/user', [UserController::class, 'createUser']);
        $group->post('/user', [UserController::class, 'loginUser']);
        $group->post('/admin', [UserController::class, 'createAdmin']);
        $group->post('/admin', [UserController::class, 'loginAdmin']);
    });
};
