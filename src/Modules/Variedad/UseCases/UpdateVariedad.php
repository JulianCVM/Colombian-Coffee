<?php

namespace App\Modules\Variedad\UseCases;


use App\Modules\Variedad\Domain\Repositories\VariedadRepositoryInterface;
use App\Modules\Variedad\DTOs\VariedadDTO;

class UpdateVariedad
{

    public function __construct(private VariedadRepositoryInterface $repo) {}

    public function execute(int $id, VariedadDTO $dto): bool
    {
        return $this->repo->update($id, $dto);
    }
}
