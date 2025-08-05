<?php

namespace App\Modules\DatosAgronomicos\Domain\Repositories;

use App\Modules\DatosAgronomicos\Domain\Models\DatosAgronomicos;
use App\Modules\DatosAgronomicos\DTOs\DatoAgroDTO;

interface DatoAgroRepositoryInterface
{
    public function getAll(): array;

    public function create(DatoAgroDTO $dto): DatosAgronomicos;

    public function update(int $identificador, DatoAgroDTO $dto): bool;

    public function delete(int $identificador): bool;
}
