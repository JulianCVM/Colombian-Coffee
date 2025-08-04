<?php

namespace App\Modules\PotencialDeRendimiento\Repositories;

use App\Modules\PotencialDeRendimiento\Domain\Models\PotencialDeRendimiento;
use App\Modules\PotencialDeRendimiento\Domain\Repositories\PotencialDeRendimientoRepositoryInterface;
use App\Modules\PotencialDeRendimiento\DTOs\PotencialDeRendimientoDTO;
use Exception;


class EloquentPotencialDeRendimientoRepository implements PotencialDeRendimientoRepositoryInterface
{
    public function getAll(): array
    {
        return PotencialDeRendimiento::all()->toArray();
    }

    public function getById(int $id): ?PotencialDeRendimiento
    {

        $potencial = PotencialDeRendimiento::find($id);
        if (!$potencial) {
            throw new Exception('El potencial de rendimiento no existe');
        }

        return $potencial;
    }

    public function create(PotencialDeRendimientoDTO $dto): PotencialDeRendimiento
    {
        $data = $dto->toArrayMapper();
        return PotencialDeRendimiento::create($data);
    }

    public function update(int $id, PotencialDeRendimientoDTO $dto): bool
    {
        $potencial = $this->getById($id);

        $data = $dto->toArrayMapper();

        return $potencial ? $potencial->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $potencial = PotencialDeRendimiento::find($id);
        return $potencial ? $potencial->delete() : false;
    }
}
