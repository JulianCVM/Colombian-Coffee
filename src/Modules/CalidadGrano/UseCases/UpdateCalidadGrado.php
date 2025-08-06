<?php

namespace App\Modules\CalidadGrano\UseCases;

use App\Modules\CalidadGrano\Domain\Repositories\CalidadGranoRepositoryInterface;
use App\Modules\CalidadGrano\DTOs\CalidadGranoDTO;

class UpdateCalidadGrado
{

    public function __construct(private CalidadGranoRepositoryInterface $repo) {}

    public function execute(int $id, CalidadGranoDTO $dto): bool
    {
        return $this->repo->update($id, $dto);
    }
}
