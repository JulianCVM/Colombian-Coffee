<?php

namespace App\Modules\Ubicacion\Repositories;

use App\Modules\Ubicacion\Domain\Models\Ubicacion;
use App\Modules\Ubicacion\Domain\Repositories\UbicacionRepositoryInterface;
use App\Modules\Ubicacion\DTOs\UbicacionDTO;
use Exception;


class EloquentUbicacionRepository implements UbicacionRepositoryInterface
{
    public function getAll(): array
    {
        return Ubicacion::all()->toArray();
    }

    public function getById(int $id): ?Ubicacion
    {

        $ubicacion = Ubicacion::find($id);
        if (!$ubicacion) {
            throw new Exception('La ubicacion no existe');
        }

        return $ubicacion;
    }

    public function create(UbicacionDTO $dto): Ubicacion
    {
        $data = $dto->toArrayMapper();
        return Ubicacion::create($data);
    }

    public function update(int $id, UbicacionDTO $dto): bool
    {
        $ubicacion = $this->getById($id);

        $data = $dto->toArrayMapper();

        return $ubicacion ? $ubicacion->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $ubicacion = Ubicacion::find($id);
        return $ubicacion ? $ubicacion->delete() : false;
    }
}
