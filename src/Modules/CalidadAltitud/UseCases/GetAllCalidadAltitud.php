<?php

namespace App\Modules\CalidadAltitud\UseCases;

use App\Modules\CalidadAltitud\Domain\Repositories\CalidadAltitudRepositoryInterface;

class GetAllCalidadAltitud
{
    public function __construct(private CalidadAltitudRepositoryInterface $repo) {}

    public function execute(): array
    {
        return $this->repo->getAll();
    }
}
