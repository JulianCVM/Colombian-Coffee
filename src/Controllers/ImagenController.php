<?php

namespace App\Controllers;

use App\Domain\Repositories\ImagenRepositoryInterface;
use App\DTOs\ImagenDTO;
use App\UseCases\GetImagenById;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

// Clase controller donde se van a manejar todas las funcionalidades del sistema recibiendo y mandando las respuestas y solicitudes

class ImagenController
{
    // Se le inyecta la interfaz del repository de variedad con la cual vamos a hacer llamado a las funciones de logica que vamos a implementar en este controller
    public function __construct(private ImagenRepositoryInterface $repo) {}


    // En la funcion obtenerImagen se hace llamado al caso de uso GetImagenById el cual hace uso de la funcion getById() de la interfaz la cual tiene como logica definida traer la imagen en especifico asociada a este id
    public function obtenerImagen(Request $request, Response $response): Response
    {

        $data = $request->getParsedBody();

        $useCase = new GetImagenById($this->repo);
        $imagen = $useCase->execute($data['id']);
        $response->getBody()->write(json_encode($imagen));
        return $response;
    }
}
