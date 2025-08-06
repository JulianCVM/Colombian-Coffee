<?php

namespace App\Modules\User\Infraestructure\Repositories;

use App\Modules\User\Domain\Model\User;
use App\Modules\User\Domain\Repositories\UserRepositoryInterface;
use App\Modules\User\DTOs\LoginDTO;
use App\Modules\User\DTOs\UserDTO;
use Exception;

class EloquentUserRepository implements UserRepositoryInterface
{

    public function create(UserDTO $dto): User
    {
        $data = $dto->toArray();
        $exists = User::where('email', $data['email'])->first();
        if ($exists) {
            // Mostrar el error
            throw new Exception('Error el usuario ya existe');
        }

        return User::create($data);
    }

    public function login(LoginDTO $dto): User
    {
        $data = $dto->toArray();
        $user = User::where('email', $data['email'])->first();

        if (!$user || !password_verify($data['password'], $user->password)) {
            throw new \Exception("Credenciales inválidas");
        }

        return $user;
    }
}
