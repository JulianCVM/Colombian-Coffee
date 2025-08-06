<?php

namespace App\Modules\Condicion\UseCases;

use App\Modules\Condicion\Domain\Repositories\CondicionRepositoryInterface;
use App\Modules\Condicion\DTOs\CondicionDTO;

class UpdateCondicion
{

    public function __construct(private CondicionRepositoryInterface $repo) {}

    public function execute(int $id, CondicionDTO $dto): bool
    {
        return $this->repo->update($id, $dto);
    }
}
