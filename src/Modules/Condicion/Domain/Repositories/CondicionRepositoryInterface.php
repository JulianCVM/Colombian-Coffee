<?php

namespace App\Modules\Condicion\Domain\Repositories;

use App\Modules\Condicion\Domain\Models\Condicion;
use App\Modules\Condicion\DTOs\CondicionDTO;

interface CondicionRepositoryInterface
{
    public function getAll(): array;

    public function create(CondicionDTO $dto): Condicion;

    public function update(int $identificador, CondicionDTO $dto): bool;

    public function delete(int $identificador): bool;
}
