<?php

namespace App\Modules\TamanhoGrano\UseCases;

use App\Modules\TamanhoGrano\Domain\Repositories\TamanhoGranoRepositoryInterface;

class GetAllTamanhoGrano
{
    public function __construct(private TamanhoGranoRepositoryInterface $repo) {}

    public function execute(): array
    {
        return $this->repo->getAll();
    }
}
