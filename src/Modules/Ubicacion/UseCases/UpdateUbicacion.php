<?php

namespace App\Modules\Ubicacion\UseCases;

use App\Modules\Ubicacion\Domain\Repositories\UbicacionRepositoryInterface;
use App\Modules\Ubicacion\DTOs\UbicacionDTO;

class UpdateUbicacion
{

    public function __construct(private UbicacionRepositoryInterface $repo) {}

    public function execute(int $id, UbicacionDTO $dto): bool
    {
        return $this->repo->update($id, $dto);
    }
}
