<?php

namespace App\Modules\User\UseCases;

use App\Modules\User\Domain\Model\User;
use App\Modules\User\Domain\Repositories\UserRepositoryInterface;
use App\Modules\User\DTOs\LoginDTO;

class LoginUser
{
    public function __construct(private UserRepositoryInterface $repo) {}

    public function execute(LoginDTO $dto): User
    {
        return $this->repo->login($dto);
    }
}
