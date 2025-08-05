<?php

namespace App\Modules\PotencialDeRendimiento\UseCases;

use App\Modules\PotencialDeRendimiento\Domain\Repositories\PotencialDeRendimientoRepositoryInterface;

class GetAllPotencialDeRendimiento
{
    public function __construct(private PotencialDeRendimientoRepositoryInterface $repo) {}

    public function execute(): array
    {
        return $this->repo->getAll();
    }
}
