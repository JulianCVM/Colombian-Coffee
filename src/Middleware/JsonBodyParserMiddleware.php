<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as Handler;

class JsonBodyParserMiddleware
{
    public function __invoke(Request $request, Handler $handler): Response
    {
        $contentType = $request->getHeaderLine('Content-Type');
        
        if (strpos($contentType, 'application/json') !== false) {
            $body = $request->getBody()->getContents();
            
            if (!empty($body)) {
                $parsedBody = json_decode($body, true);
                
                if (json_last_error() === JSON_ERROR_NONE) {
                    $request = $request->withParsedBody($parsedBody);
                }
            }
        }
        
        return $handler->handle($request);
    }
}