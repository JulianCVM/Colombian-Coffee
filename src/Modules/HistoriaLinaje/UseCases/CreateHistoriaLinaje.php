<?php

namespace App\Modules\HistoriaLinaje\UseCases;

use App\Modules\HistoriaLinaje\Domain\Models\HistoriaLinaje;
use App\Modules\HistoriaLinaje\Domain\Repositories\HistoriaLinajeRepositoryInterface;
use App\Modules\HistoriaLinaje\DTOs\HistoriaLinajeDTO;

class CreateHistoriaLinaje
{
    public function __construct(private HistoriaLinajeRepositoryInterface $repo) {}

    public function execute(HistoriaLinajeDTO $dto): ?HistoriaLinaje
    {
        return $this->repo->create($dto);
    }
}
