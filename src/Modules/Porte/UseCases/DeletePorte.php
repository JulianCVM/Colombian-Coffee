<?php

namespace App\Modules\Porte\UseCases;

use App\Modules\Porte\Domain\Repositories\PorteRepositoryInterface;

class DeletePorte
{
    public function __construct(private PorteRepositoryInterface $repo) {}

    public function execute(int $id): bool
    {
        return $this->repo->delete($id);
    }
}
