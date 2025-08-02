<?php

namespace App\UseCases;

use App\Domain\Repositories\UserRepositoryInterface;
use App\DTOs\LoginDTO;
use App\Services\JwtService;

class LoginUsuarioUseCase
{
    private UserRepositoryInterface $repo;

    public function __construct(UserRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function __invoke(LoginDTO $dto): array
    {
        $user = $this->repo->findByEmail($dto->email);

        if (!$user || !password_verify($dto->password, $user->password)) {
            throw new \Exception("Credenciales inválidas", 401);
        }

        $token = JwtService::sign([
            'id' => $user->id,
            'email' => $user->email,
            'rol' => $user->rol,
            'nombre' => $user->nombre
        ]);

        return [
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'nombre' => $user->nombre,
                'email' => $user->email,
                'rol' => $user->rol
            ]
        ];
    }
}