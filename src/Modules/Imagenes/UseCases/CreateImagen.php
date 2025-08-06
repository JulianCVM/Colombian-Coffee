<?php

namespace App\Modules\Imagenes\UseCases;

use App\Modules\Imagenes\Domain\Models\Imagen;
use App\Modules\Imagenes\Domain\Repositories\ImagenRepositoryInterface;
use App\Modules\Imagenes\DTOs\ImagenDTO;

class CreateImagen
{
    public function __construct(private ImagenRepositoryInterface $repo) {}

    public function execute(ImagenDTO $dto): ?Imagen
    {
        return $this->repo->create($dto);
    }
}
