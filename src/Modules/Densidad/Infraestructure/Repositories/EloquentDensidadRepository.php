<?php

namespace App\Modules\Densidad\Infraestructure\Repositories;

use App\Modules\Densidad\Domain\Models\Densidad;
use App\Modules\Densidad\Domain\Repositories\DensidadRepositoryInterface;
use App\Modules\Densidad\DTOs\DensidadDTO;
use Exception;


class EloquentDensidadRepository implements DensidadRepositoryInterface
{
    public function getAll(): array
    {
        return Densidad::all()->toArray();
    }

    public function getById(int $id): ?Densidad
    {

        $densidad = Densidad::find($id);
        if (!$densidad) {
            throw new Exception('La densidad no existe');
        }

        return $densidad;
    }

    public function create(DensidadDTO $dto): Densidad
    {
        $data = $dto->toArrayMapper();
        return Densidad::create($data);
    }

    public function update(int $id, DensidadDTO $dto): bool
    {
        $densidad = $this->getById($id);

        $data = $dto->toArrayMapper();

        return $densidad ? $densidad->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $densidad = Densidad::find($id);
        return $densidad ? $densidad->delete() : false;
    }
}
