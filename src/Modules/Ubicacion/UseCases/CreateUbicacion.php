<?php

namespace App\Modules\Ubicacion\UseCases;

use App\Modules\Ubicacion\Domain\Models\Ubicacion;
use App\Modules\Ubicacion\Domain\Repositories\UbicacionRepositoryInterface;
use App\Modules\Ubicacion\DTOs\UbicacionDTO;

class CreateUbicacion
{
    public function __construct(private UbicacionRepositoryInterface $repo) {}

    public function execute(UbicacionDTO $dto): ?Ubicacion
    {
        return $this->repo->create($dto);
    }
}
