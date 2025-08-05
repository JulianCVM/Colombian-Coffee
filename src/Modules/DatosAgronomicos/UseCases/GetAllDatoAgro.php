<?php

namespace App\Modules\DatosAgronomicos\UseCases;

use App\Modules\DatosAgronomicos\Domain\Repositories\DatoAgroRepositoryInterface;

class GetAllDatoAgro
{
    public function __construct(private DatoAgroRepositoryInterface $repo) {}

    public function execute(): array
    {
        return $this->repo->getAll();
    }
}
