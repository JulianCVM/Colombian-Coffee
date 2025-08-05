<?php

namespace App\Modules\Enfermedad\UseCases;

use App\Modules\Enfermedad\Domain\Repositories\EnfermedadRepositoryInterface;

class DeleteEnfermedad
{
    public function __construct(private EnfermedadRepositoryInterface $repo) {}

    public function execute(int $id): bool
    {
        return $this->repo->delete($id);
    }
}
