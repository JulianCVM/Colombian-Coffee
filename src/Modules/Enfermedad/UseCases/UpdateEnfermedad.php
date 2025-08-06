<?php

namespace App\Modules\Enfermedad\UseCases;

use App\Modules\Enfermedad\Domain\Repositories\EnfermedadRepositoryInterface;
use App\Modules\Enfermedad\DTOs\EnfermedadDTO;

class UpdateEnfermedad
{

    public function __construct(private EnfermedadRepositoryInterface $repo) {}

    public function execute(int $id, EnfermedadDTO $dto): bool
    {
        return $this->repo->update($id, $dto);
    }
}
