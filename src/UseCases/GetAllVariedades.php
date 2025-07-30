<?php

namespace App\UseCases;

use App\Domain\Repositories\VariedadRepositoryInterface;

class GetAllVariedades
{
    public function __construct(private VariedadRepositoryInterface $repo) {}

    public function execute(): array
    {
        return $this->repo->getAll();
    }
}
