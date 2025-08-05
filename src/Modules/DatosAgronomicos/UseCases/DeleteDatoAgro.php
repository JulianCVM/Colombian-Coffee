<?php

namespace App\Modules\DatosAgronomicos\UseCases;

use App\Modules\DatosAgronomicos\Domain\Repositories\DatoAgroRepositoryInterface;

class DeleteDatoAgro
{
    public function __construct(private DatoAgroRepositoryInterface $repo) {}

    public function execute(int $id): bool
    {
        return $this->repo->delete($id);
    }
}
