<?php

use App\Controllers\VariedadController;
use Slim\App;

return function (App $app) {
    $app->group('/variedad', function ($group) {
        $group->get('', [VariedadController::class, 'index']);
    });
};
