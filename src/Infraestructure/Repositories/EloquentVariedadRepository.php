<?php

namespace App\Infraestructure\Repositories;

use App\Domain\Models\Variedad;
use App\Domain\Repositories\VariedadRepositoryInterface;

class EloquentVariedadRepository implements VariedadRepositoryInterface
{
    public function getAll(): array
    {
        // SELECT * FROM variedad;
        return Variedad::all()->toArray();
    }

    public function getById(int $identificador): ?Variedad
    {
        // SELECT * FROM variedad WHERE id = $identificador;
        // return Variedad::find($identificador);

        // SELECT * FROM variedad WHERE id = $identificador;
        return Variedad::where('id', $identificador)->first();
    }

    public function create(array $data): Variedad
    {
        $exist = $this->getById($data['id']);
        if ($exist) {
            return $exist;
        }
        return Variedad::create($data);
    }

    public function update(int $identificador, array $data): bool
    {
        // SELECT * FROM variedad WHERE id = $identificador;
        $variedad = $this->getById($identificador);
        // UPDATE variedad SET nombre = $data [x] ... WHERE id = $identificador;
        return $variedad ? $variedad->update($data) : false;
    }

    public function delete(int $identificador): bool
    {
        // SELECT * FROM variedad WHERE id = $identificador;
        $variedad = Variedad::find($identificador);
        // DELETE FROM variedad WHERE id = $identificador;
        return $variedad ? $variedad->delete() : false;
    }
}
