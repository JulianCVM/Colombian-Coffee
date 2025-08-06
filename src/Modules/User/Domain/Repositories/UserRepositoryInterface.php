<?php

namespace App\Modules\User\Domain\Repositories;

use App\Modules\User\Domain\Model\User;
use App\Modules\User\DTOs\UserDTO;

interface UserRepositoryInterface
{
    public function create(UserDTO $dto): User;
}
