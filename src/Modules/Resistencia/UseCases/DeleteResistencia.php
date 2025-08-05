<?php

namespace App\Modules\Resistencia\UseCases;

use App\Modules\Resistencia\Domain\Repositories\ResistenciaRepositoryInterface;

class DeleteResistencia
{
    public function __construct(private ResistenciaRepositoryInterface $repo) {}

    public function execute(int $id): bool
    {
        return $this->repo->delete($id);
    }
}
