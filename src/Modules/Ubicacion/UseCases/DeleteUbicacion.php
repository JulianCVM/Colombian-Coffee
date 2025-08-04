<?php

namespace App\Modules\Ubicacion\UseCases;

use App\Modules\Ubicacion\Domain\Repositories\UbicacionRepositoryInterface;

class DeleteUbicacion
{
    public function __construct(private UbicacionRepositoryInterface $repo) {}

    public function execute(int $id): bool
    {
        return $this->repo->delete($id);
    }
}
