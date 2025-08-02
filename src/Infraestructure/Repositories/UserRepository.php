<?php

namespace App\Infraestructure\Repositories;

use App\Domain\Repositories\UserRepositoryInterface;
use App\Domain\Models\User;
use App\DTOs\UserDTO;

class UserRepository implements UserRepositoryInterface
{
    public function getAll(): array
    {
        try {
            return User::select('id', 'nombre', 'email', 'rol', 'creado_en')->get()->toArray();
        } catch (\Exception $e) {
            throw new \Exception("Error al obtener usuarios: " . $e->getMessage());
        }
    }

    public function getById(int $identificdor): ?User
    {
        try {
            return User::find($identificdor);
        } catch (\Exception $e) {
            throw new \Exception("Error al buscar usuario por ID: " . $e->getMessage());
        }
    }

    public function findByEmail(string $email): ?User
    {
        try {
            return User::where('email', $email)->first();
        } catch (\Exception $e) {
            throw new \Exception("Error al buscar usuario por email: " . $e->getMessage());
        }
    }

    public function create(UserDTO $dto): User
    {
        try {
            $hashedPassword = password_hash($dto->password, PASSWORD_BCRYPT);
            
            return User::create([
                'nombre' => $dto->nombre,
                'email' => $dto->email,
                'password' => $hashedPassword,
                'rol' => $dto->rol
            ]);
        } catch (\Exception $e) {
            throw new \Exception("Error al crear usuario: " . $e->getMessage());
        }
    }

    public function update(int $id, UserDTO $dto): bool
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return false;
            }

            $hashedPassword = password_hash($dto->password, PASSWORD_BCRYPT);
            
            return $user->update([
                'nombre' => $dto->nombre,
                'email' => $dto->email,
                'password' => $hashedPassword,
                'rol' => $dto->rol
            ]);
        } catch (\Exception $e) {
            throw new \Exception("Error al actualizar usuario: " . $e->getMessage());
        }
    }

    public function delete(int $id): bool
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return false;
            }

            return $user->delete();
        } catch (\Exception $e) {
            throw new \Exception("Error al eliminar usuario: " . $e->getMessage());
        }
    }
}