<?php

namespace App\Modules\DatosAgronomicos\UseCases;

use App\Modules\DatosAgronomicos\Domain\Models\DatosAgronomicos;
use App\Modules\DatosAgronomicos\Domain\Repositories\DatoAgroRepositoryInterface;
use App\Modules\DatosAgronomicos\DTOs\DatoAgroDTO;

class CreateDatoAgro
{
    public function __construct(private DatoAgroRepositoryInterface $repo) {}

    public function execute(DatoAgroDTO $dto): ?DatosAgronomicos
    {
        return $this->repo->create($dto);
    }
}
