<?php

namespace App\Modules\TamanhoGrano\Repositories;

use App\Modules\TamanhoGrano\Domain\Models\TamanhoGrano;
use App\Modules\TamanhoGrano\Domain\Repositories\TamanhoGranoRepositoryInterface;
use App\Modules\TamanhoGrano\DTOs\TamanhoGranoDTO;
use Exception;


class EloquentTamanhoGranoRepository implements TamanhoGranoRepositoryInterface
{
    public function getAll(): array
    {
        return TamanhoGrano::all()->toArray();
    }

    public function getById(int $id): ?TamanhoGrano
    {

        $tamanho = TamanhoGrano::find($id);
        if (!$tamanho) {
            throw new Exception('El tamanho de rendimiento no existe caralho');
        }

        return $tamanho;
    }

    public function create(TamanhoGranoDTO $dto): TamanhoGrano
    {
        $data = $dto->toArrayMapper();
        return TamanhoGrano::create($data);
    }

    public function update(int $id, TamanhoGranoDTO $dto): bool
    {
        $tamanho = $this->getById($id);

        $data = $dto->toArrayMapper();

        return $tamanho ? $tamanho->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $tamanho = TamanhoGrano::find($id);
        return $tamanho ? $tamanho->delete() : false;
    }
}
