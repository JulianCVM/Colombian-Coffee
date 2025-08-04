<?php

namespace App\Domain\Repositories;

use App\Domain\Models\Imagen;
use App\DTOs\ImagenDTO;

// Se crea la interfaz con la cual se definen que metodos se van a implementar para este modulo
interface ImagenRepositoryInterface
{
    // funcion de obtener toda la data
    public function getAll(): array;

    // funcion de obtener la data de imagen especifica filtrando por id
    public function getById(int $identificador): ?Imagen;

    // funcion que permite crear un DTO de imagen
    public function create(ImagenDTO $dto): Imagen;

    // funcion que permite editar un DTO de imagen
    public function update(int $identificador, ImagenDTO $dto): bool;

    // funcion que permite eliminar un registro de imagen
    public function delete(int $identificador): bool;
}
