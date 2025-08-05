<?php

namespace App\Modules\Resistencia\UseCases;

use App\Modules\Resistencia\Domain\Repositories\ResistenciaRepositoryInterface;
use App\Modules\Resistencia\DTOs\ResistenciaDTO;

class UpdateResistencia
{

    public function __construct(private ResistenciaRepositoryInterface $repo) {}

    public function execute(int $id, ResistenciaDTO $dto): bool
    {
        return $this->repo->update($id, $dto);
    }
}
