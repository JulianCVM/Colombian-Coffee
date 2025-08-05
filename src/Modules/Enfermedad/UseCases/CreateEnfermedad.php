<?php

namespace App\Modules\Enfermedad\UseCases;

use App\Modules\Enfermedad\Domain\Models\Enfermedad;
use App\Modules\Enfermedad\Domain\Repositories\EnfermedadRepositoryInterface;
use App\Modules\Enfermedad\DTOs\EnfermedadDTO;

class CreateEnfermedad
{
    public function __construct(private EnfermedadRepositoryInterface $repo) {}

    public function execute(EnfermedadDTO $dto): ?Enfermedad
    {
        return $this->repo->create($dto);
    }
}
