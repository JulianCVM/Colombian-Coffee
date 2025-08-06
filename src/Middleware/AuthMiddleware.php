<?php

namespace App\Middleware;

use App\Modules\User\Domain\Model\User;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use Slim\Exception\HttpUnauthorizedException;
use Slim\Psr7\Response as SlimResponse;

class AuthMiddleware
{
    // $repo = new AuthMiddleware() <- ()
    //    public function __construct() {}
    public function __invoke(Request $request, Handler $handler): Response
    {
        $auth = $request->getHeaderLine('Authorization'); // Basic YJhkjh83289Hs9aP9S8HDUn8fh94w...

        if (!$auth || !str_starts_with($auth, 'Basic ')) {
            throw new HttpUnauthorizedException($request);
        }

        $decoded = base64_decode(substr($auth, 6));
        [$email, $password] = explode(':', $decoded); // asd@gmail.com:12345

        // Cambiar al repositorio encargado......
        $user = User::where('email', $email)->first();

        // Validaos la contraseña
        if (!$user || !password_verify($password, $user->password)) {
            throw new HttpUnauthorizedException($request);
        }

        $request = $request->withAttribute('user', $user);

        return $handler->handle($request);
    }
}
