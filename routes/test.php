<?php
use Slim\App;

return function (App $app) {
    $app->get('/ping', function ($req, $res) {
        $res->getBody()->write('pong');
        return $res;
    });
};
