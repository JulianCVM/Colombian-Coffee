<?php

namespace App\Modules\User\UseCases;

use App\Modules\User\Domain\Model\User;
use App\Modules\User\Domain\Repositories\UserRepositoryInterface;
use App\Modules\User\DTOs\UserDTO;

class CreateUser
{
    public function __construct(private UserRepositoryInterface $repo) {}

    public function execute(UserDTO $user): ?User
    {
        return $this->repo->create($user);
    }
}
