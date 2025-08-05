<?php

namespace App\Modules\DatosAgronomicos\Infraestructure\Repositories;

use App\Modules\DatosAgronomicos\Domain\Models\DatosAgronomicos;
use App\Modules\DatosAgronomicos\Domain\Repositories\DatoAgroRepositoryInterface;
use App\Modules\DatosAgronomicos\DTOs\DatoAgroDTO;
use Exception;


class EloquentDatoAgroRepository implements DatoAgroRepositoryInterface
{
    public function getAll(): array
    {
        return DatosAgronomicos::all()->toArray();
    }

    public function getById(int $id): ?DatosAgronomicos
    {

        $dato = DatosAgronomicos::find($id);
        if (!$dato) {
            throw new Exception('El dato agronomico no existe');
        }

        return $dato;
    }

    public function create(DatoAgroDTO $dto): DatosAgronomicos
    {
        $data = $dto->toArrayMapper();
        return DatosAgronomicos::create($data);
    }

    public function update(int $id, DatoAgroDTO $dto): bool
    {
        $dato = $this->getById($id);

        $data = $dto->toArrayMapper();

        return $dato ? $dato->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $dato = DatosAgronomicos::find($id);
        return $dato ? $dato->delete() : false;
    }
}
