<?php

namespace App\Domain\Repositories;

use App\Domain\Models\Variedad;

interface VariedadRepositoryInterface
{
    public function getAll(): array;
    public function getById(int $identificador): ?Variedad;
    public function create(array $data): Variedad;
    public function update(int $identificador, array $data): bool;
    public function delete(int $identificador): bool;
}
