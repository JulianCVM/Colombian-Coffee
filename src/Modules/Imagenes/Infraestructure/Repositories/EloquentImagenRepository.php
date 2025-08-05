<?php

namespace App\Modules\Imagenes\Infraestructure\Repositories;

use Exception;
use App\Modules\Imagenes\Domain\Models\Imagen;
use App\Modules\Imagenes\Domain\Repositories\ImagenRepositoryInterface;
use App\Modules\Imagenes\DTOs\ImagenDTO;

// Este es el repository de donde se van a implementar todas las querys directas a la DB usando el ORM
class EloquentImagenRepository implements ImagenRepositoryInterface
{
    // funcion para obtener toda la data
    public function getAll(): array
    {
        return Imagen::all()->toArray();
    }

    // funcion para obtener un dato en especifico filtrado por id
    public function getById(int $identificador): ?Imagen
    {
        $variedad = Imagen::find($identificador);
        if (!$variedad) {
            throw new Exception('La imagen no existe');
        }

        return $variedad;
    }

    // funcion para insertar datos
    public function create(ImagenDTO $dto): Imagen
    {
        $data = $dto->toArrayMapper();
        return Imagen::create($data);
    }

    // funcion para actualizar datos
    public function update(int $identificador, ImagenDTO $dto): bool
    {
        $variedad = $this->getById($identificador);

        $data = $dto->toArrayMapper();

        return $variedad ? $variedad->update($data) : false;
    }

    // funcion para eliminar datos
    public function delete(int $identificador): bool
    {
        $variedad = Imagen::find($identificador);
        return $variedad ? $variedad->delete() : false;
    }
}
