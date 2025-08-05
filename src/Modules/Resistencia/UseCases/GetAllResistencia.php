<?php

namespace App\Modules\Resistencia\UseCases;

use App\Modules\Resistencia\Domain\Repositories\ResistenciaRepositoryInterface;

class GetAllResistencia
{
    public function __construct(private ResistenciaRepositoryInterface $repo) {}

    public function execute(): array
    {
        return $this->repo->getAll();
    }
}
