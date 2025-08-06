<?php

use App\Modules\User\Controller\UserController;
use Slim\App;

return function (App $app) {

    $app->group('/register', function ($group) {
        $group->post('/user', [UserController::class, 'storeUser']);
        $group->post('/admin', [UserController::class, 'createAdmin']);
    });
};
