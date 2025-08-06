<?php

namespace App\Modules\CalidadAltitud\Domain\Repositories;

use App\Modules\CalidadAltitud\Domain\Models\CalidadAltitud;
use App\Modules\CalidadAltitud\DTOs\CalidadAltitudDTO;

interface CalidadAltitudRepositoryInterface
{
    public function getAll(): array;

    public function create(CalidadAltitudDTO $dto): CalidadAltitud;

    public function update(int $identificador, CalidadAltitudDTO $dto): bool;

    public function delete(int $identificador): bool;
}
