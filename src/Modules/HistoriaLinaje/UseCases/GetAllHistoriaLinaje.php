<?php

namespace App\Modules\HistoriaLinaje\UseCases;

use App\Modules\HistoriaLinaje\Domain\Repositories\HistoriaLinajeRepositoryInterface;

class GetAllHistoriaLinaje
{
    public function __construct(private HistoriaLinajeRepositoryInterface $repo) {}

    public function execute(): array
    {
        return $this->repo->getAll();
    }
}
