<?php

namespace App\Modules\CalidadAltitud\UseCases;

use App\Modules\CalidadAltitud\Domain\Repositories\CalidadAltitudRepositoryInterface;

class DeleteCalidadAltitud
{
    public function __construct(private CalidadAltitudRepositoryInterface $repo) {}

    public function execute(int $id): bool
    {
        return $this->repo->delete($id);
    }
}
