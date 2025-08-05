<?php

namespace App\Modules\DatosAgronomicos\UseCases;

use App\Modules\DatosAgronomicos\Domain\Repositories\DatoAgroRepositoryInterface;
use App\Modules\DatosAgronomicos\DTOs\DatoAgroDTO;

class UpdateDatoAgro
{

    public function __construct(private DatoAgroRepositoryInterface $repo) {}

    public function execute(int $id, DatoAgroDTO $dto): bool
    {
        return $this->repo->update($id, $dto);
    }
}
