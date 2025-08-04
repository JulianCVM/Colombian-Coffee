<?php

namespace App\Modules\PotencialDeRendimiento\UseCases;

use App\Modules\PotencialDeRendimiento\Domain\Models\PotencialDeRendimiento;
use App\Modules\PotencialDeRendimiento\Domain\Repositories\PotencialDeRendimientoRepositoryInterface;
use App\Modules\PotencialDeRendimiento\DTOs\PotencialDeRendimientoDTO;

class CreatePotencialDeRendimiento
{
    public function __construct(private PotencialDeRendimientoRepositoryInterface $repo) {}

    public function execute(PotencialDeRendimientoDTO $dto): ?PotencialDeRendimiento
    {
        return $this->repo->create($dto);
    }
}
