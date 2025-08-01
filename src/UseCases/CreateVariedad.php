<?php

namespace App\UseCases;

use App\Domain\Models\Variedad;
use App\Domain\Repositories\VariedadRepositoryInterface;
use App\DTOs\VariedadDTO;

class CreateVariedad
{
    public function __construct(private VariedadRepositoryInterface $repo) {}

    public function execute(VariedadDTO  $dto): ?Variedad
    {
        return $this->repo->create($dto);
    }
}
