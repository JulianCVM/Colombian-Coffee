<?php

namespace App\Handler;

use InvalidArgumentException;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpMethodNotAllowedException;
use Slim\Exception\HttpNotFoundException;
use Slim\Exception\HttpUnauthorizedException;
use Slim\Interfaces\ErrorHandlerInterface;
use Throwable;

// clase para generar el manejo de errores personalizados para la API
class CustomErrorHandler implements ErrorHandlerInterface
{

    // se inyecta el ResponseFactoryInterface
    public function __construct(private ResponseFactoryInterface $response) {}

    // funcion magica para manejar los errores
    public function __invoke(ServerRequestInterface $request, Throwable $exception, bool $displayErrorDetails, bool $logErrors, bool $logErrorDetails): ResponseInterface
    {
        $status = 500;
        $message = "Error interno en el servidor";

        if ($exception instanceof HttpNotFoundException) {
            $status = 404;
            $message = 'Ruta no encontrada';
        } elseif ($exception instanceof HttpUnauthorizedException) {
            $status = 401;
            $message = $exception->getMessage();
        } elseif ($exception instanceof InvalidArgumentException) {
            $status = 422;
            $message = $exception->getMessage();
        } elseif ($exception instanceof HttpMethodNotAllowedException) {
            $status = 405;
            $message = $exception->getMessage();
        }

        $response = $this->response->createResponse($status);
        $response->getBody()->write(json_encode(['error' => $message]));
        return $response->withHeader('Content-Type', 'application/json');
    }
}
