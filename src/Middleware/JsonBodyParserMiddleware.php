<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as Handler;

class JsonBodyParserMiddleware implements MiddlewareInterface
{
    public function process(Request $request, Handler $handler): Response
    {
        $contentType = $request->getHeaderLine('Content-Type');

        // Verificar si el Content-Type contiene application/json
        if (str_contains($contentType, 'application/json')) {
            $body = $request->getBody()->getContents();

            // Solo procesar si hay contenido en el body
            if (!empty($body)) {
                $data = json_decode($body, true);

                // Solo actualizar si el JSON es válido
                if (json_last_error() === JSON_ERROR_NONE && $data !== null) {
                    $request = $request->withParsedBody($data);
                }
            }
        }

        return $handler->handle($request);
    }
}
