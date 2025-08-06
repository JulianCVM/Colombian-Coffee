<?php

namespace App\Modules\Imagenes\Domain\Repositories;

use App\Modules\Imagenes\Domain\Models\Imagen;
use App\Modules\Imagenes\DTOs\ImagenDTO;

// Se crea la interfaz con la cual se definen que metodos se van a implementar para este modulo
interface ImagenRepositoryInterface
{
    // funcion de obtener toda la data
    public function getAll(): array;

    // funcion que permite crear un DTO de imagen
    public function create(ImagenDTO $dto): Imagen;

    // funcion que permite editar un DTO de imagen
    public function update(int $identificador, ImagenDTO $dto): bool;

    // funcion que permite eliminar un registro de imagen
    public function delete(int $identificador): bool;
}
