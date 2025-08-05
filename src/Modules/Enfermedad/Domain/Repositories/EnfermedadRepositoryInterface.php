<?php

namespace App\Modules\Enfermedad\Domain\Repositories;

use App\Modules\Enfermedad\Domain\Models\Enfermedad;
use App\Modules\Enfermedad\DTOs\EnfermedadDTO;

interface EnfermedadRepositoryInterface
{
    public function getAll(): array;

    public function create(EnfermedadDTO $dto): Enfermedad;

    public function update(int $identificador, EnfermedadDTO $dto): bool;

    public function delete(int $identificador): bool;
}
