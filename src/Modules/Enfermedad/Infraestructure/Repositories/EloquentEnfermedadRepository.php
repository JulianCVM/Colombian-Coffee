<?php

namespace App\Modules\Enfermedad\Infraestructure\Repositories;

use App\Modules\Enfermedad\Domain\Models\Enfermedad;
use App\Modules\Enfermedad\Domain\Repositories\EnfermedadRepositoryInterface;
use App\Modules\Enfermedad\DTOs\EnfermedadDTO;
use Exception;


class EloquentEnfermedadRepository implements EnfermedadRepositoryInterface
{
    public function getAll(): array
    {
        return Enfermedad::all()->toArray();
    }

    public function getById(int $id): ?Enfermedad
    {

        $enfermedad = Enfermedad::find($id);
        if (!$enfermedad) {
            throw new Exception('La Enfermedad no existe');
        }

        return $enfermedad;
    }

    public function create(EnfermedadDTO $dto): Enfermedad
    {
        $data = $dto->toArrayMapper();
        return Enfermedad::create($data);
    }

    public function update(int $id, EnfermedadDTO $dto): bool
    {
        $enfermedad = $this->getById($id);

        $data = $dto->toArrayMapper();

        return $enfermedad ? $enfermedad->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $enfermedad = Enfermedad::find($id);
        return $enfermedad ? $enfermedad->delete() : false;
    }
}
