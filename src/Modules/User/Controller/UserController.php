<?php

namespace App\Modules\User\Controller;

use App\Modules\User\Domain\Model\User;
use App\Modules\User\Domain\Repositories\UserRepositoryInterface;
use App\Modules\User\DTOs\LoginDTO;
use App\Modules\User\DTOs\UserDTO;
use App\Modules\User\UseCases\CreateUser;
use App\Modules\User\UseCases\LoginUser;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserController
{
    public function __construct(private UserRepositoryInterface $repo) {}

    public function storeUser(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        try {
            $dto = UserDTO::fromArrayMapper($data);
            $useCase = new CreateUser($this->repo);
            $result = $useCase->execute($dto);

            if (!$result) {
                return $this->json($response, ["error" => "No se pudo crear el usuario"], 400);
            }

            return $this->json($response, $result, 201);
        } catch (\InvalidArgumentException $e) {
            return $this->json($response, ["error" => $e->getMessage()], 422);
        } catch (\Throwable $e) {
            return $this->json($response, ["error" => "Error interno del servidor"], 500);
        }
    }

    public function createAdmin(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();
        $data['rol'] = 'admin';

        try {
            $dto = UserDTO::fromArrayMapper($data);
            $useCase = new CreateUser($this->repo);
            $result = $useCase->execute($dto);

            if (!$result) {
                return $this->json($response, ["error" => "No se pudo crear el administrador"], 400);
            }

            return $this->json($response, $result, 201);
        } catch (\InvalidArgumentException $e) {
            return $this->json($response, ["error" => $e->getMessage()], 422);
        } catch (\Throwable $e) {
            return $this->json($response, ["error" => "Error interno del servidor"], 500);
        }
    }

    private function json(Response $response, mixed $data, int $status = 200): Response
    {
        $response->getBody()->write(json_encode($data));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($status);
    }


    private function generateJWT(User $user): string
    {
        $secret = $_ENV['JWT_SECRET'] ?? 'supersecreto';
        $payload = [
            'sub' => $user->id,
            'email' => $user->email,
            'rol' => $user->rol,
            'exp' => time() + (60 * 60 * 24) // 24h
        ];

        return \Firebase\JWT\JWT::encode($payload, $secret, 'HS256');
    }

    public function loginUser(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        try {
            $dto = LoginDTO::fromArrayMapper($data);
            $useCase = new LoginUser($this->repo);
            $user = $useCase->execute($dto);

            // Generar el JWT
            $token = $this->generateJWT($user);

            return $this->json($response, [
                'success' => true,
                'user' => [
                    'id' => $user->id,
                    'nombre' => $user->nombre,
                    'email' => $user->email,
                    'rol' => $user->rol
                ],
                'token' => $token
            ], 200);
        } catch (\InvalidArgumentException $e) {
            return $this->json($response, ["error" => $e->getMessage()], 422);
        } catch (\Throwable $e) {
            return $this->json($response, ["error" => $e->getMessage()], 401);
        }
    }
}
