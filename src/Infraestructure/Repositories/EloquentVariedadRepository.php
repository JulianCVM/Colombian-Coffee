<?php

namespace App\Infraestructure\Repositories;

use App\Domain\Models\Variedad;
use App\Domain\Repositories\VariedadRepositoryInterface;
use Exception;
use App\DTOs\VariedadDTO;


// Este es el repository de donde se van a implementar todas las querys directas a la DB usando el ORM
class EloquentVariedadRepository implements VariedadRepositoryInterface
{
    // funcion para obtener toda la data
    public function getAll(): array
    {
        // SELECT * FROM variedad;
        return Variedad::all()->toArray();
    }

    // funcion para obtener un dato en especifico filtrado por id
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

    // funcion para insertar datos
    public function create(VariedadDTO $dto): Variedad
    {
        $data = $dto->toArrayMapper();
        $exist = $this->getById($data['id']);
        if ($exist) {
            throw new Exception('Error el usuario ya existe');
        }
        return Variedad::create($data);
    }

    // funcion para actualizar datos
    public function update(int $identificador, VariedadDTO $dto): bool
    {
        // SELECT * FROM variedad WHERE id = $identificador;
        $variedad = $this->getById($identificador);

        $data = $dto->toArrayMapper();

        // UPDATE variedad SET nombre = $data [x] ... WHERE id = $identificador;
        return $variedad ? $variedad->update($data) : false;
    }

    // funcion para eliminar datos
    public function delete(int $identificador): bool
    {
        // SELECT * FROM variedad WHERE id = $identificador;
        $variedad = Variedad::find($identificador);
        // DELETE FROM variedad WHERE id = $identificador;
        return $variedad ? $variedad->delete() : false;
    }
}
