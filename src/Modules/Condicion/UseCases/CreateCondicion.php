<?php

namespace App\Modules\Condicion\UseCases;

use App\Modules\Condicion\Domain\Models\Condicion;
use App\Modules\Condicion\Domain\Repositories\CondicionRepositoryInterface;
use App\Modules\Condicion\DTOs\CondicionDTO;

class CreateCondicion
{
    public function __construct(private CondicionRepositoryInterface $repo) {}

    public function execute(CondicionDTO $dto): ?Condicion
    {
        return $this->repo->create($dto);
    }
}
