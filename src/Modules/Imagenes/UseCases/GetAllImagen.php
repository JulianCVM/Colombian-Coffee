<?php

namespace App\Modules\Imagenes\UseCases;

use App\Modules\Imagenes\Domain\Repositories\ImagenRepositoryInterface;

class GetAllImagen
{
    public function __construct(private ImagenRepositoryInterface $repo) {}

    public function execute(): array
    {
        return $this->repo->getAll();
    }
}
