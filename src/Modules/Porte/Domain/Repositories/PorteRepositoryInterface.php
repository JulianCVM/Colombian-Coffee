<?php

namespace App\Modules\Porte\Domain\Repositories;

use App\Modules\Porte\Domain\Models\Porte;
use App\Modules\Porte\DTOs\PorteDTO;

interface PorteRepositoryInterface
{
    public function getAll(): array;

    public function create(PorteDTO $dto): Porte;

    public function update(int $identificador, PorteDTO $dto): bool;

    public function delete(int $identificador): bool;
}
