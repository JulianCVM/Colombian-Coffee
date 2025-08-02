<?php

namespace App\Domain\Repositories;

use App\Domain\Models\User;
use App\DTOs\UserDTO;

interface UserRepositoryInterface
{
    // funcion para obtener todos los usuarios
    public function getAll(): array;
    // funcion para obtener usuario por ID
    public function getById(int $id): ?User;
    // funcion para obtener usuario por email
    public function findByEmail(string $email): ?User;
    // funcion para crear usuarios
    public function create(UserDTO $dto): User;
    // funcion para actualizar usuarios
    public function update(int $id, UserDTO $dto): bool;
    // funcion para eliminar usuarios
    public function delete(int $id): bool;
}
