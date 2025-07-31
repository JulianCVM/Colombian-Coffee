<?php

namespace App\UseCases;

use App\Domain\Models\Imagen;
use App\Domain\Repositories\ImagenRepositoryInterface;

// caso de uso para obtener la data de una imagen en especifico inyectandole la interfaz del repository
class GetImagenById
{
    public function __construct(private ImagenRepositoryInterface $repo) {}

    public function execute(int $identificador): Imagen
    {
        return $this->repo->getById($identificador);
    }
}
