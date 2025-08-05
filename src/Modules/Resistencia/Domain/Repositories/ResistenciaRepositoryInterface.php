<?php

namespace App\Modules\Resistencia\Domain\Repositories;

use App\Modules\Resistencia\Domain\Models\Resistencia;
use App\Modules\Resistencia\DTOs\ResistenciaDTO;

interface ResistenciaRepositoryInterface
{
    public function getAll(): array;

    public function create(ResistenciaDTO $dto): Resistencia;

    public function update(int $identificador, ResistenciaDTO $dto): bool;

    public function delete(int $identificador): bool;
}
