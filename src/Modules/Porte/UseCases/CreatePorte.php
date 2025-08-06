<?php

namespace App\Modules\Porte\UseCases;

use App\Modules\Porte\Domain\Models\Porte;
use App\Modules\Porte\Domain\Repositories\PorteRepositoryInterface;
use App\Modules\Porte\DTOs\PorteDTO;

class CreatePorte
{
    public function __construct(private PorteRepositoryInterface $repo) {}

    public function execute(PorteDTO $dto): ?Porte
    {
        return $this->repo->create($dto);
    }
}
