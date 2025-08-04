<?php

namespace App\Modules\Variedad\Domain\Repositories;

use App\Modules\Variedad\Domain\Models\Variedad;
use App\Modules\Variedad\DTOs\VariedadDTO;

// Se crea la interfaz con la cual se definen que metodos se van a implementar para este modulo
interface VariedadRepositoryInterface
{
    // funcion de obtener toda la data
    public function getAll(): array;

    // funcion que permite crear un DTO de variedad
    public function create(VariedadDTO $dto): Variedad;

    // funcion que permite editar un DTO de variedad
    public function update(int $identificador, VariedadDTO $dto): bool;

    // funcion que permite eliminar un registro de variedad
    public function delete(int $identificador): bool;
}
