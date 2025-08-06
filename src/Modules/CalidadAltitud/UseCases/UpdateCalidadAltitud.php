<?php

namespace App\Modules\CalidadAltitud\UseCases;

use App\Modules\CalidadAltitud\Domain\Repositories\CalidadAltitudRepositoryInterface;
use App\Modules\CalidadAltitud\DTOs\CalidadAltitudDTO;

class UpdateCalidadAltitud
{

    public function __construct(private CalidadAltitudRepositoryInterface $repo) {}

    public function execute(int $id, CalidadAltitudDTO $dto): bool
    {
        return $this->repo->update($id, $dto);
    }
}
