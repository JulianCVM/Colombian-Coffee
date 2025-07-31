<?php
namespace App\Middleware;

use App\Services\JwtService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as Handler;
use Slim\Psr7\Response as SlimResponse;

final class AuthMiddleware
{
    /** @var string[]|null */
    private ?array $roles;

    /**
     * @param string[]|null $roles  Lista de roles permitidos (p.ej. ['admin']).
     *                              Si es null, solo verifica autenticación.
     */
    public function __construct(?array $roles = null)
    {
        $this->roles = $roles;
    }

    public function __invoke(Request $request, Handler $handler): Response
    {
        $authHeader = $request->getHeaderLine('Authorization');
        if (!preg_match('/^Bearer\s+(.+)$/i', $authHeader, $m)) {
            return $this->json(401, ['error' => 'Unauthorized: missing bearer token']);
        }

        $token = $m[1] ?? '';
        try {
            // Verificamos el token usando JwtService
            $payload = JwtService::verify($token);

            // Si hay restricción de roles, valida el rol del token
            if ($this->roles !== null) {
                $userRole = $payload->role ?? null;
                if (!$userRole || !in_array($userRole, $this->roles, true)) {
                    return $this->json(403, ['error' => 'Forbidden: insufficient role']);
                }
            }

            // Pasamos el payload a la request (por si el controlador lo necesita)
            $request = $request->withAttribute('auth', $payload);

            return $handler->handle($request);

        } catch (\Throwable $e) {
            return $this->json(401, ['error' => 'Unauthorized: invalid or expired token']);
        }
    }

    private function json(int $status, array $data): Response
    {
        $res = new SlimResponse($status);
        $res->getBody()->write(json_encode($data, JSON_UNESCAPED_UNICODE));
        return $res->withHeader('Content-Type', 'application/json');
    }
}
