<?php

namespace App\Modules\Enfermedad\UseCases;

use App\Modules\Enfermedad\Domain\Repositories\EnfermedadRepositoryInterface;

class GetAllEnfermedad
{
    public function __construct(private EnfermedadRepositoryInterface $repo) {}

    public function execute(): array
    {
        return $this->repo->getAll();
    }
}
