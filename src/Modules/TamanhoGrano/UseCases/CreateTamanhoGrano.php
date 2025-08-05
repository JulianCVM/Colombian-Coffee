<?php

namespace App\Modules\TamanhoGrano\UseCases;

use App\Modules\TamanhoGrano\Domain\Models\TamanhoGrano;
use App\Modules\TamanhoGrano\Domain\Repositories\TamanhoGranoRepositoryInterface;
use App\Modules\TamanhoGrano\DTOs\TamanhoGranoDTO;

class CreateTamanhoGrano
{
    public function __construct(private TamanhoGranoRepositoryInterface $repo) {}

    public function execute(TamanhoGranoDTO $dto): ?TamanhoGrano
    {
        return $this->repo->create($dto);
    }
}
