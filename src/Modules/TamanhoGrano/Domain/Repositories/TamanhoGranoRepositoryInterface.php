<?php

namespace App\Modules\TamanhoGrano\Domain\Repositories;

use App\Modules\TamanhoGrano\Domain\Models\TamanhoGrano;
use App\Modules\TamanhoGrano\DTOs\TamanhoGranoDTO;

interface TamanhoGranoRepositoryInterface
{
    public function getAll(): array;

    public function create(TamanhoGranoDTO $dto): TamanhoGrano;

    public function update(int $identificador, TamanhoGranoDTO $dto): bool;

    public function delete(int $identificador): bool;
}
