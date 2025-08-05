<?php

namespace App\Modules\CalidadGrano\UseCases;

use App\Modules\CalidadGrano\Domain\Repositories\CalidadGranoRepositoryInterface;

class GetAllCalidadGrado
{
    public function __construct(private CalidadGranoRepositoryInterface $repo) {}

    public function execute(): array
    {
        return $this->repo->getAll();
    }
}
