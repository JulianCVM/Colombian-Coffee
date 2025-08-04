<?php

namespace App\Modules\Imagenes\UseCases;

use App\Modules\Imagenes\Domain\Repositories\ImagenRepositoryInterface;

class DeleteImagen
{
    public function __construct(private ImagenRepositoryInterface $repo) {}

    public function execute(int $id): bool
    {
        return $this->repo->delete($id);
    }
}
