<?php

namespace App\Modules\Densidad\UseCases;

use App\Modules\Densidad\Domain\Repositories\DensidadRepositoryInterface;
use App\Modules\Densidad\DTOs\DensidadDTO;

class UpdateDensidad
{

    public function __construct(private DensidadRepositoryInterface $repo) {}

    public function execute(int $id, DensidadDTO $dto): bool
    {
        return $this->repo->update($id, $dto);
    }
}
