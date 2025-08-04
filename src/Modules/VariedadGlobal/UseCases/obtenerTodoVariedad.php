<?php

namespace App\Modules\VariedadGlobal\UseCases;

use App\Modules\VariedadGlobal\Domain\Repositories\VariedadGlobalRepositoryInterface;

// caso de uso para obtener toda la data de variedades inyectandole la interfaz del repository
class obtenerTodoVariedad
{
    public function __construct(private VariedadGlobalRepositoryInterface $repo) {}

    public function execute(): array
    {
        return $this->repo->obtenerTodo();
    }
}
