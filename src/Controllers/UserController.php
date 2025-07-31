<?php

namespace App\Controllers;

use App\Domain\Models\User;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\UseCases\LoginUsuarioUseCase;
use Slim\Psr7\Response as SlimResponse;
use App\Domain\Repositories\UserRepositoryInterface;
use App\DTOs\LoginDTO;


class UserController
{
    public function __construct(private UserRepositoryInterface $repo) {}


    // hacer la logica de todo esto despues

    // public function createUser(Request $request, Response $response): Response {}

    public function loginUser(Request $request, Response $response): Response
{
    $data = $request->getParsedBody();

    // Valida campos obligatorios
    if (empty($data['email']) || empty($data['password'])) {
        $response->getBody()->write(json_encode(['error' => 'Email y password requeridos']));
        return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
    }

    try {
        $dto = new LoginDTO($data['email'], $data['password']);
        $login = new LoginUsuarioUseCase($this->repo);
        $token = $login($dto);

        $response->getBody()->write(json_encode(['token' => $token]));
        return $response->withHeader('Content-Type', 'application/json');

    } catch (\Throwable $e) {
        $response->getBody()->write(json_encode(['error' => $e->getMessage()]));
        return $response->withStatus($e->getCode() ?: 500)->withHeader('Content-Type', 'application/json');
    }
}

    // public function createAdmin(Request $request, Response $response): Response {}

    
}
