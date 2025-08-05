<?php

namespace App\Modules\PotencialDeRendimiento\Domain\Repositories;

use App\Modules\PotencialDeRendimiento\Domain\Models\PotencialDeRendimiento;
use App\Modules\PotencialDeRendimiento\DTOs\PotencialDeRendimientoDTO;

interface PotencialDeRendimientoRepositoryInterface
{
    public function getAll(): array;

    public function create(PotencialDeRendimientoDTO $dto): PotencialDeRendimiento;

    public function update(int $identificador, PotencialDeRendimientoDTO $dto): bool;

    public function delete(int $identificador): bool;
}
