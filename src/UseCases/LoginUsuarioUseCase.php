<?php

namespace App\UseCases;

use App\Domain\Repositories\UserRepositoryInterface;
use App\DTOs\UserDTO;
use App\Services\JwtService;

class LoginUsuarioUseCase
{
    private UserRepositoryInterface $repo;

    public function __construct(UserRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function __invoke(UserDTO $dto): string
    {
        $user = $this->repo->findByEmail($dto->email);

        if (!$user || !password_verify($dto->password, $user->getPassword())) {
            throw new \Exception("Credenciales inválidas", 401);
        }

        return JwtService::sign([
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'role' => $user->getRole(),
        ]);
    }
}
