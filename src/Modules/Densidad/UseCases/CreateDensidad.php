<?php

namespace App\Modules\Densidad\UseCases;

use App\Modules\Densidad\Domain\Models\Densidad;
use App\Modules\Densidad\Domain\Repositories\DensidadRepositoryInterface;
use App\Modules\Densidad\DTOs\DensidadDTO;

class CreateDensidad
{
    public function __construct(private DensidadRepositoryInterface $repo) {}

    public function execute(DensidadDTO $dto): ?Densidad
    {
        return $this->repo->create($dto);
    }
}
