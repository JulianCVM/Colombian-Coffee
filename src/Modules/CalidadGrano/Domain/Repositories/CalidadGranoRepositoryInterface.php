<?php

namespace App\Modules\CalidadGrano\Domain\Repositories;

use App\Modules\CalidadGrano\Domain\Models\CalidadGrano;
use App\Modules\CalidadGrano\DTOs\CalidadGranoDTO;

interface CalidadGranoRepositoryInterface
{
    public function getAll(): array;

    public function create(CalidadGranoDTO $dto): CalidadGrano;

    public function update(int $identificador, CalidadGranoDTO $dto): bool;

    public function delete(int $identificador): bool;
}
