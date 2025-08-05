<?php

namespace App\Modules\CalidadGrano\UseCases;

use App\Modules\CalidadGrano\Domain\Models\CalidadGrano;
use App\Modules\CalidadGrano\Domain\Repositories\CalidadGranoRepositoryInterface;
use App\Modules\CalidadGrano\DTOs\CalidadGranoDTO;

class CreateCalidadGrado
{
    public function __construct(private CalidadGranoRepositoryInterface $repo) {}

    public function execute(CalidadGranoDTO $dto): ?CalidadGrano
    {
        return $this->repo->create($dto);
    }
}
