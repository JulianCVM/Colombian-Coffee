<?php

namespace App\Modules\Condicion\UseCases;

use App\Modules\Condicion\Domain\Repositories\CondicionRepositoryInterface;

class GetAllCondicion
{
    public function __construct(private CondicionRepositoryInterface $repo) {}

    public function execute(): array
    {
        return $this->repo->getAll();
    }
}
