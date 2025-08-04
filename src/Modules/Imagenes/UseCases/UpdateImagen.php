<?php

namespace App\Modules\Imagenes\UseCases;

use App\Modules\Imagenes\Domain\Repositories\ImagenRepositoryInterface;
use App\Modules\Imagenes\DTOs\ImagenDTO;

class UpdateImagen
{

    public function __construct(private ImagenRepositoryInterface $repo) {}

    public function execute(int $id, ImagenDTO $dto): bool
    {
        return $this->repo->update($id, $dto);
    }
}
