<?php

use App\Modules\User\Controller\UserController;
use Slim\App;

return function (App $app) {

    $app->group('/auth', function ($group) {
        $group->post('/login', [UserController::class, 'loginUser']);
    });
};
