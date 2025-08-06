<?php

namespace App\Modules\Densidad\Domain\Repositories;

use App\Modules\Densidad\Domain\Models\Densidad;
use App\Modules\Densidad\DTOs\DensidadDTO;

interface DensidadRepositoryInterface
{
    public function getAll(): array;

    public function create(DensidadDTO $dto): Densidad;

    public function update(int $identificador, DensidadDTO $dto): bool;

    public function delete(int $identificador): bool;
}
