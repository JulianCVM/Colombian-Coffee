<?php

namespace App\Modules\HistoriaLinaje\Infraestructure\Repositories;

use App\Modules\HistoriaLinaje\Domain\Models\HistoriaLinaje;
use App\Modules\HistoriaLinaje\Domain\Repositories\HistoriaLinajeRepositoryInterface;
use App\Modules\HistoriaLinaje\DTOs\HistoriaLinajeDTO;
use Exception;


class EloquentHistoriaLinajeRepository implements HistoriaLinajeRepositoryInterface
{
    public function getAll(): array
    {
        return HistoriaLinaje::all()->toArray();
    }

    public function getById(int $id): ?HistoriaLinaje
    {

        $HistoriaLinaje = HistoriaLinaje::find($id);
        if (!$HistoriaLinaje) {
            throw new Exception('La Historia no existe');
        }

        return $HistoriaLinaje;
    }

    public function create(HistoriaLinajeDTO $dto): HistoriaLinaje
    {
        $data = $dto->toArrayMapper();
        return HistoriaLinaje::create($data);
    }

    public function update(int $id, HistoriaLinajeDTO $dto): bool
    {
        $historia = $this->getById($id);

        $data = $dto->toArrayMapper();

        return $historia ? $historia->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $historia = HistoriaLinaje::find($id);
        return $historia ? $historia->delete() : false;
    }
}
