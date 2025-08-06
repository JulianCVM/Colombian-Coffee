<?php

namespace App\Modules\Porte\Repositories;

use App\Modules\Porte\Domain\Models\Porte;
use App\Modules\Porte\Domain\Repositories\PorteRepositoryInterface;
use App\Modules\Porte\DTOs\PorteDTO;
use Exception;


class EloquentPorteRepository implements PorteRepositoryInterface
{
    public function getAll(): array
    {
        return Porte::all()->toArray();
    }

    public function getById(int $id): ?Porte
    {

        $porte = Porte::find($id);
        if (!$porte) {
            throw new Exception('El porte no existe');
        }

        return $porte;
    }

    public function create(PorteDTO $dto): Porte
    {
        $data = $dto->toArrayMapper();
        return Porte::create($data);
    }

    public function update(int $id, PorteDTO $dto): bool
    {
        $porte = $this->getById($id);

        $data = $dto->toArrayMapper();

        return $porte ? $porte->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $porte = Porte::find($id);
        return $porte ? $porte->delete() : false;
    }
}
