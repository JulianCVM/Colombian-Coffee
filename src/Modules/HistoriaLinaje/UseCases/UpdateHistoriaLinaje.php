<?php

namespace App\Modules\HistoriaLinaje\UseCases;

use App\Modules\HistoriaLinaje\Domain\Repositories\HistoriaLinajeRepositoryInterface;
use App\Modules\HistoriaLinaje\DTOs\HistoriaLinajeDTO;

class UpdateHistoriaLinaje
{

    public function __construct(private HistoriaLinajeRepositoryInterface $repo) {}

    public function execute(int $id, HistoriaLinajeDTO $dto): bool
    {
        return $this->repo->update($id, $dto);
    }
}
