<?php

namespace App\Modules\Variedad\UseCases;

use App\Modules\Variedad\Domain\Repositories\VariedadRepositoryInterface;

class DeleteVariedad
{
    public function __construct(private VariedadRepositoryInterface $repo) {}

    public function execute(int $identificador): bool
    {
        return $this->repo->delete($identificador);
    }
}
