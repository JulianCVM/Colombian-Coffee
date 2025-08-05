<?php

namespace App\Modules\CalidadGrano\Infraestructure\Repositories;

use App\Modules\CalidadGrano\Domain\Models\CalidadGrano;
use App\Modules\CalidadGrano\Domain\Repositories\CalidadGranoRepositoryInterface;
use App\Modules\CalidadGrano\DTOs\CalidadGranoDTO;
use Exception;


class EloquentCalidadGranoRepository implements CalidadGranoRepositoryInterface
{
    public function getAll(): array
    {
        return CalidadGrano::all()->toArray();
    }

    public function getById(int $id): ?CalidadGrano
    {

        $calidadG = CalidadGrano::find($id);
        if (!$calidadG) {
            throw new Exception('La calidad grano no existe');
        }

        return $calidadG;
    }

    public function create(CalidadGranoDTO $dto): CalidadGrano
    {
        $data = $dto->toArrayMapper();
        return CalidadGrano::create($data);
    }

    public function update(int $id, CalidadGranoDTO $dto): bool
    {
        $calidadG = $this->getById($id);

        $data = $dto->toArrayMapper();

        return $calidadG ? $calidadG->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $calidadG = CalidadGrano::find($id);
        return $calidadG ? $calidadG->delete() : false;
    }
}
