<?php

namespace App\Modules\User\Domain\Repositories;

use App\Modules\User\Domain\Model\User;
use App\Modules\User\DTOs\LoginDTO;
use App\Modules\User\DTOs\UserDTO;

interface UserRepositoryInterface
{
    public function create(UserDTO $dto): User;

    public function login(LoginDTO $dto): User;
}
