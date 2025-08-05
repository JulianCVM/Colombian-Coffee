<?php

namespace App\Modules\CalidadAltitud\Infraestructure\Repositories;

use App\Modules\CalidadAltitud\Domain\Models\CalidadAltitud;
use App\Modules\CalidadAltitud\Domain\Repositories\CalidadAltitudRepositoryInterface;
use App\Modules\CalidadAltitud\DTOs\CalidadAltitudDTO;
use Exception;


class EloquentCalidadAltitudRepository implements CalidadAltitudRepositoryInterface
{
    public function getAll(): array
    {
        return CalidadAltitud::all()->toArray();
    }

    public function getById(int $id): ?CalidadAltitud
    {

        $calidadAlt = CalidadAltitud::find($id);
        if (!$calidadAlt) {
            throw new Exception('La calidad altitud no existe');
        }

        return $calidadAlt;
    }

    public function create(CalidadAltitudDTO $dto): CalidadAltitud
    {
        $data = $dto->toArrayMapper();
        return CalidadAltitud::create($data);
    }

    public function update(int $id, CalidadAltitudDTO $dto): bool
    {
        $calidadAlt = $this->getById($id);

        $data = $dto->toArrayMapper();

        return $calidadAlt ? $calidadAlt->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $calidadAlt = CalidadAltitud::find($id);
        return $calidadAlt ? $calidadAlt->delete() : false;
    }
}
