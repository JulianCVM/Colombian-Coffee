<?php

namespace App\Modules\User\Controller;

use App\Modules\User\Domain\Repositories\UserRepositoryInterface;
use App\Modules\User\DTOs\UserDTO;
use App\Modules\User\UseCases\CreateUser;
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
}
