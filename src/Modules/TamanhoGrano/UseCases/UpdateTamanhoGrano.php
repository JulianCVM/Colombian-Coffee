<?php

namespace App\Modules\TamanhoGrano\UseCases;

use App\Modules\TamanhoGrano\Domain\Repositories\TamanhoGranoRepositoryInterface;
use App\Modules\TamanhoGrano\DTOs\TamanhoGranoDTO;

class UpdateTamanhoGrano
{

    public function __construct(private TamanhoGranoRepositoryInterface $repo) {}

    public function execute(int $id, TamanhoGranoDTO $dto): bool
    {
        return $this->repo->update($id, $dto);
    }
}
