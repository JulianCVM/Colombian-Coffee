<?php

namespace App\Modules\HistoriaLinaje\UseCases;

use App\Modules\HistoriaLinaje\Domain\Repositories\HistoriaLinajeRepositoryInterface;

class DeleteHistoriaLinaje
{
    public function __construct(private HistoriaLinajeRepositoryInterface $repo) {}

    public function execute(int $id): bool
    {
        return $this->repo->delete($id);
    }
}
