<?php

namespace App\Modules\Resistencia\Infraestructure\Repositories;

use App\Modules\Resistencia\Domain\Models\Resistencia;
use App\Modules\Resistencia\Domain\Repositories\ResistenciaRepositoryInterface;
use App\Modules\Resistencia\DTOs\ResistenciaDTO;
use Exception;


class EloquentResistenciaRepository implements ResistenciaRepositoryInterface
{
    public function getAll(): array
    {
        return Resistencia::all()->toArray();
    }

    public function getById(int $id): ?Resistencia
    {

        $resistencia = Resistencia::find($id);
        if (!$resistencia) {
            throw new Exception('La resistencia no existe');
        }

        return $resistencia;
    }

    public function create(ResistenciaDTO $dto): Resistencia
    {
        $data = $dto->toArrayMapper();
        return Resistencia::create($data);
    }

    public function update(int $id, ResistenciaDTO $dto): bool
    {
        $resistencia = $this->getById($id);

        $data = $dto->toArrayMapper();

        return $resistencia ? $resistencia->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $resistencia = Resistencia::find($id);
        return $resistencia ? $resistencia->delete() : false;
    }
}
