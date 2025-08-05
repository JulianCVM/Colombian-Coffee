<?php

namespace App\Modules\Porte\UseCases;

use App\Modules\Porte\Domain\Repositories\PorteRepositoryInterface;
use App\Modules\Porte\DTOs\PorteDTO;

class UpdatePorte
{

    public function __construct(private PorteRepositoryInterface $repo) {}

    public function execute(int $id, PorteDTO $dto): bool
    {
        return $this->repo->update($id, $dto);
    }
}
