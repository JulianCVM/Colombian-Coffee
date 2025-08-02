<?php

namespace App\Controllers;

use App\Domain\Models\User;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\UseCases\LoginUsuarioUseCase;
use App\UseCases\CreateUserUseCase;
use App\Domain\Repositories\UserRepositoryInterface;
use App\DTOs\LoginDTO;
use App\DTOs\UserDTO;

class UserController
{
    public function __construct(private UserRepositoryInterface $repo) {}

    /**
     * Login de usuario
     */
    public function loginUser(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        // Valida campos obligatorios
        if (empty($data['email']) || empty($data['password'])) {
            $response->getBody()->write(json_encode([
                'error' => 'Email y password requeridos'
            ]));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        try {
            $dto = new LoginDTO($data['email'], $data['password']);
            $login = new LoginUsuarioUseCase($this->repo);
            $result = $login($dto);

            $response->getBody()->write(json_encode([
                'success' => true,
                'token' => $result['token'],
                'user' => $result['user']
            ]));
            return $response->withHeader('Content-Type', 'application/json');

        } catch (\Throwable $e) {
            $response->getBody()->write(json_encode([
                'error' => $e->getMessage()
            ]));
            return $response->withStatus($e->getCode() ?: 500)->withHeader('Content-Type', 'application/json');
        }
    }

    /**
     * Crear usuario regular
     */
    public function createUser(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        // Validaciones básicas
        if (empty($data['nombre']) || empty($data['email']) || empty($data['password'])) {
            $response->getBody()->write(json_encode([
                'error' => 'Nombre, email y password son requeridos'
            ]));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        try {
            $dto = new UserDTO(
                $data['nombre'],
                $data['email'],
                $data['password'],
                'user' // Rol por defecto
            );
            
            $createUser = new CreateUserUseCase($this->repo);
            $user = $createUser($dto);

            $response->getBody()->write(json_encode([
                'success' => true,
                'message' => 'Usuario creado exitosamente',
                'user' => $user
            ]));
            return $response->withStatus(201)->withHeader('Content-Type', 'application/json');

        } catch (\Throwable $e) {
            $response->getBody()->write(json_encode([
                'error' => $e->getMessage()
            ]));
            return $response->withStatus($e->getCode() ?: 500)->withHeader('Content-Type', 'application/json');
        }
    }

    /**
     * Crear administrador
     */
    public function createAdmin(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        // Validaciones básicas
        if (empty($data['nombre']) || empty($data['email']) || empty($data['password'])) {
            $response->getBody()->write(json_encode([
                'error' => 'Nombre, email y password son requeridos'
            ]));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        try {
            $dto = new UserDTO(
                $data['nombre'],
                $data['email'],
                $data['password'],
                'admin' // Rol de administrador
            );
            
            $createUser = new CreateUserUseCase($this->repo);
            $user = $createUser($dto);

            $response->getBody()->write(json_encode([
                'success' => true,
                'message' => 'Administrador creado exitosamente',
                'user' => $user
            ]));
            return $response->withStatus(201)->withHeader('Content-Type', 'application/json');

        } catch (\Throwable $e) {
            $response->getBody()->write(json_encode([
                'error' => $e->getMessage()
            ]));
            return $response->withStatus($e->getCode() ?: 500)->withHeader('Content-Type', 'application/json');
        }
    }
}