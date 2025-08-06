<?php

namespace App\Middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpUnauthorizedException;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;


class AuthMiddleware
{
    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $authHeader = $request->getHeaderLine('Authorization');

        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            throw new HttpUnauthorizedException($request, 'Token no proporcionado');
        }

        $token = substr($authHeader, 7);

        try {
            $decoded = JWT::decode($token, new Key($_ENV['JWT_SECRET'], 'HS256'));

            // Puedes agregar los datos del usuario al request para usar más adelante
            $request = $request->withAttribute('user', $decoded);

            return $handler->handle($request);
        } catch (\Exception $e) {
            throw new HttpUnauthorizedException($request, 'Token inválido o expirado');
        }
    }
}
