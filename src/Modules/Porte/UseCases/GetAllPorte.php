<?php

namespace App\Modules\Porte\UseCases;

use App\Modules\Porte\Domain\Repositories\PorteRepositoryInterface;

class GetAllPorte
{
    public function __construct(private PorteRepositoryInterface $repo) {}

    public function execute(): array
    {
        return $this->repo->getAll();
    }
}
