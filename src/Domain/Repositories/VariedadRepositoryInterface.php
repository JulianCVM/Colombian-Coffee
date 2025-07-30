<?php

namespace App\Domain\Repositories;

use App\Domain\Models\Variedad;
use App\DTOs\VariedadDTO;

interface VariedadRepositoryInterface
{
    public function getAll(): array;
    public function getById(int $identificador): ?Variedad;
    public function create(VariedadDTO $dto): Variedad;
    public function update(int $identificador, VariedadDTO $dto): bool;
    public function delete(int $identificador): bool;
}
