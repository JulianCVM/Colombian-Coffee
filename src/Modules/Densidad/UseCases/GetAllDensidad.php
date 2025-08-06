<?php

namespace App\Modules\Densidad\UseCases;

use App\Modules\Densidad\Domain\Repositories\DensidadRepositoryInterface;

class GetAllDensidad
{
    public function __construct(private DensidadRepositoryInterface $repo) {}

    public function execute(): array
    {
        return $this->repo->getAll();
    }
}
