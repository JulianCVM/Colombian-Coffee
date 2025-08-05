<?php

namespace App\Modules\Densidad\UseCases;

use App\Modules\Densidad\Domain\Repositories\DensidadRepositoryInterface;

class DeleteDensidad
{
    public function __construct(private DensidadRepositoryInterface $repo) {}

    public function execute(int $id): bool
    {
        return $this->repo->delete($id);
    }
}
