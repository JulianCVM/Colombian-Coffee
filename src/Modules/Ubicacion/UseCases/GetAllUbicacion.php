<?php

namespace App\Modules\Ubicacion\UseCases;

use App\Modules\Ubicacion\Domain\Repositories\UbicacionRepositoryInterface;

class GetAllUbicacion
{
    public function __construct(private UbicacionRepositoryInterface $repo) {}

    public function execute(): array
    {
        return $this->repo->getAll();
    }
}
