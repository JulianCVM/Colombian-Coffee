<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as Handler;

// middleware para manejar siempre el header de application/json del Content-Type
class JsonBodyParserMiddleware implements MiddlewareInterface
{

    public function process(Request $request, Handler $handler): Response
    {
        $contentType = $request->getHeaderLine('Content-Type');
        if (strtr($contentType, ["application/json"])) {
            $data = json_decode(file_get_contents("php://input"), true);
            $request = $request->withParsedBody($data);
        }

        return $handler->handle($request);
    }
}
