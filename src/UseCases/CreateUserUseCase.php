<?php

namespace App\UseCases;

use App\Domain\Repositories\UserRepositoryInterface;
use App\DTOs\UserDTO;

class CreateUserUseCase
{
    private UserRepositoryInterface $repo;

    public function __construct(UserRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function __invoke(UserDTO $dto): array
    {
        // Verificar si el email ya existe
        $existingUser = $this->repo->findByEmail($dto->email);
        if ($existingUser) {
            throw new \Exception("El email ya está registrado", 409);
        }

        // Crear el usuario
        $user = $this->repo->create($dto);

        return [
            'id' => $user->id,
            'nombre' => $user->nombre,
            'email' => $user->email,
            'rol' => $user->rol
        ];
    }
}