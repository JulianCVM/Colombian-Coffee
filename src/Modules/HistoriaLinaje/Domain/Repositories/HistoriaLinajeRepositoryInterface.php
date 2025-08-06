<?php

namespace App\Modules\HistoriaLinaje\Domain\Repositories;

use App\Modules\HistoriaLinaje\Domain\Models\HistoriaLinaje;
use App\Modules\HistoriaLinaje\DTOs\HistoriaLinajeDTO;

interface HistoriaLinajeRepositoryInterface
{
    public function getAll(): array;

    public function create(HistoriaLinajeDTO $dto): HistoriaLinaje;

    public function update(int $identificador, HistoriaLinajeDTO $dto): bool;

    public function delete(int $identificador): bool;
}
