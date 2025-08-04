<?php

namespace App\Modules\Condicion\Infraestructure\Repositories;

use App\Modules\Condicion\Domain\Models\Condicion;
use App\Modules\Condicion\Domain\Repositories\CondicionRepositoryInterface;
use App\Modules\Condicion\DTOs\CondicionDTO;
use Exception;


class EloquentCondicionRepository implements CondicionRepositoryInterface
{
    public function getAll(): array
    {
        return Condicion::all()->toArray();
    }

    public function getById(int $id): ?Condicion
    {

        $condicion = Condicion::find($id);
        if (!$condicion) {
            throw new Exception('La Condicion no existe');
        }

        return $condicion;
    }

    public function create(CondicionDTO $dto): Condicion
    {
        $data = $dto->toArrayMapper();
        return Condicion::create($data);
    }

    public function update(int $id, CondicionDTO $dto): bool
    {
        $condicion = $this->getById($id);

        $data = $dto->toArrayMapper();

        return $condicion ? $condicion->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $condicion = Condicion::find($id);
        return $condicion ? $condicion->delete() : false;
    }
}
