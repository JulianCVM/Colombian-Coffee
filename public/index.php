<?php

// importaciones necesarias para el funcionamiento de la API y de PSR
use Slim\App;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as Handler;

// Este apartado implementa los middlewares que se van a usar en la API

return function (App $app) {

    // Se implementa un handler para las respuestas para que manejen siempre el encabezado con Content-Type: application/json sin importar que ruta sea
    $app->add(function (Request $req, Handler $han): Response {
        $response = $han->handle($req);
        return $response->withHeader('Content-Type', 'application/json');
    });
};
