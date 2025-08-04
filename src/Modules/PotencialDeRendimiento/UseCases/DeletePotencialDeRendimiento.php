<?php

namespace App\Modules\PotencialDeRendimiento\UseCases;

use App\Modules\PotencialDeRendimiento\Domain\Repositories\PotencialDeRendimientoRepositoryInterface;

class DeletePotencialDeRendimiento
{
    public function __construct(private PotencialDeRendimientoRepositoryInterface $repo) {}

    public function execute(int $id): bool
    {
        return $this->repo->delete($id);
    }
}
