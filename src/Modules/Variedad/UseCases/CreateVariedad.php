<?php

namespace App\Modules\Variedad\UseCases;

use App\Modules\Variedad\Domain\Models\Variedad;
use App\Modules\Variedad\Domain\Repositories\VariedadRepositoryInterface;
use App\Modules\Variedad\DTOs\VariedadDTO;

class CreateVariedad
{
    public function __construct(private VariedadRepositoryInterface $repo) {}

    public function execute(VariedadDTO  $dto): ?Variedad
    {
        return $this->repo->create($dto);
    }
}
