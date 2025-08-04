<?php

namespace App\Modules\TamanhoGrano\UseCases;

use App\Modules\TamanhoGrano\Domain\Repositories\TamanhoGranoRepositoryInterface;

class DeleteTamanhoGrano
{
    public function __construct(private TamanhoGranoRepositoryInterface $repo) {}

    public function execute(int $id): bool
    {
        return $this->repo->delete($id);
    }
}
