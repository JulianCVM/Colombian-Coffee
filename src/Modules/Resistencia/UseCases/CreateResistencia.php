<?php

namespace App\Modules\Resistencia\UseCases;

use App\Modules\Resistencia\Domain\Models\Resistencia;
use App\Modules\Resistencia\Domain\Repositories\ResistenciaRepositoryInterface;
use App\Modules\Resistencia\DTOs\ResistenciaDTO;

class CreateResistencia
{
    public function __construct(private ResistenciaRepositoryInterface $repo) {}

    public function execute(ResistenciaDTO $dto): ?Resistencia
    {
        return $this->repo->create($dto);
    }
}
