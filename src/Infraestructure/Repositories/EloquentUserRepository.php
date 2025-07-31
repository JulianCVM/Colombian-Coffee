<?php

namespace App\Infraestructure\Repositories;

use App\Domain\Models\User;
use App\Domain\Repositories\UserRepositoryInterface;
use Exception;
use App\DTOs\UserDTO;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function getAll(): array
    {
        return User::all()->toArray();
    }

    public function getById(int $id): ?User
    {
        $variedad = User::find($id);
        if (!$variedad) {
            throw new Exception('El usuario buscado por ID no existe');
        }

        return $variedad;
    }

    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function create(UserDTO $dto): User
    {
        $data = $dto->toArrayMapper();
        $exists = User::where('email', $data['email'])->first();
        if ($exists) {
            // Mostrar el error
            throw new Exception('Error el usuario ya existe');
        }

        return User::create($data);
    }

    public function update(int $id, UserDTO $dto): bool
    {
        $variedad = $this->getById($id);

        $data = $dto->toArrayMapper();

        return $variedad ? $variedad->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $variedad = User::find($id);
        return $variedad ? $variedad->delete() : false;
    }
}
