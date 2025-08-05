<?php

namespace App\Modules\CalidadGrano\UseCases;

use App\Modules\CalidadGrano\Domain\Repositories\CalidadGranoRepositoryInterface;

class DeleteCalidadGrado
{
    public function __construct(private CalidadGranoRepositoryInterface $repo) {}

    public function execute(int $id): bool
    {
        return $this->repo->delete($id);
    }
}
