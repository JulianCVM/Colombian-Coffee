<?php

namespace App\Modules\CalidadAltitud\UseCases;

use App\Modules\CalidadAltitud\Domain\Models\CalidadAltitud;
use App\Modules\CalidadAltitud\Domain\Repositories\CalidadAltitudRepositoryInterface;
use App\Modules\CalidadAltitud\DTOs\CalidadAltitudDTO;

class CreateCalidadAltitud
{
    public function __construct(private CalidadAltitudRepositoryInterface $repo) {}

    public function execute(CalidadAltitudDTO $dto): ?CalidadAltitud
    {
        return $this->repo->create($dto);
    }
}
