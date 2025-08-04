<?php

namespace App\Modules\Variedad\UseCases;

use App\Modules\Variedad\Domain\Repositories\VariedadRepositoryInterface;

// caso de uso para obtener toda la data de variedades inyectandole la interfaz del repository
class GetAllVariedades
{
    public function __construct(private VariedadRepositoryInterface $repo) {}

    public function execute(): array
    {
        return $this->repo->getAll();
    }
}
