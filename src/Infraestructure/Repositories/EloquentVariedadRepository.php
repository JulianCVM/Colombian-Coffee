<?php

namespace App\Infraestructure\Repositories;

use App\Domain\Models\Variedad;
use App\Domain\Repositories\VariedadRepositoryInterface;
use Exception;
use App\DTOs\VariedadDTO;

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

        // Implementacion de logica de validador

        $variedad = Variedad::find($identificador);
        if (!$variedad) {
            throw new Exception('La variedad no existe');
        }

        return $variedad;
    }

    public function create(VariedadDTO $dto): Variedad
    {
        $data = $dto->toArrayMapper();
        $exist = $this->getById($data['id']);
        if ($exist) {
            throw new Exception('Error el usuario ya existe');
        }
        return Variedad::create($data);
    }

    public function update(int $identificador, VariedadDTO $dto): bool
    {
        // SELECT * FROM variedad WHERE id = $identificador;
        $variedad = $this->getById($identificador);

        $data = $dto->toArrayMapper();

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
