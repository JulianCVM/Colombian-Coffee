<?php

namespace App\Modules\Condicion\UseCases;

use App\Modules\Condicion\Domain\Repositories\CondicionRepositoryInterface;

class DeleteCondicion
{
    public function __construct(private CondicionRepositoryInterface $repo) {}

    public function execute(int $id): bool
    {
        return $this->repo->delete($id);
    }
}
