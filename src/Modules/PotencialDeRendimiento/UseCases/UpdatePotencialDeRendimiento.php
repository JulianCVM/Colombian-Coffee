<?php

namespace App\Modules\PotencialDeRendimiento\UseCases;

use App\Modules\PotencialDeRendimiento\Domain\Repositories\PotencialDeRendimientoRepositoryInterface;
use App\Modules\PotencialDeRendimiento\DTOs\PotencialDeRendimientoDTO;

class UpdatePotencialDeRendimiento
{

    public function __construct(private PotencialDeRendimientoRepositoryInterface $repo) {}

    public function execute(int $id, PotencialDeRendimientoDTO $dto): bool
    {
        return $this->repo->update($id, $dto);
    }
}
