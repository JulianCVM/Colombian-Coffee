<?php

namespace App\Modules\Ubicacion\Domain\Repositories;

use App\Modules\Ubicacion\Domain\Models\Ubicacion;
use App\Modules\Ubicacion\DTOs\UbicacionDTO;

interface UbicacionRepositoryInterface
{
    public function getAll(): array;

    public function create(UbicacionDTO $dto): Ubicacion;

    public function update(int $id, UbicacionDTO $dto): bool;

    public function delete(int $id): bool;
}
