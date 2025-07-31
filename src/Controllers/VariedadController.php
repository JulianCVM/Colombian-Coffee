<?php

namespace App\Controllers;

use App\Domain\Repositories\VariedadRepositoryInterface;
use App\UseCases\GetAllVariedades;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

// Clase controller donde se van a manejar todas las funcionalidades del sistema recibiendo y mandando las respuestas y solicitudes

class VariedadController
{
    // Se le inyecta la interfaz del repository de variedad con la cual vamos a hacer llamado a las funciones de logica que vamos a implementar en este controller
    public function __construct(private VariedadRepositoryInterface $repo) {}


    // En la funcion index se hace llamado al caso de uso GetAllVariedades el cual hace uso de la funcion getAll() de la interfaz la cual tiene como logica definida traer toda la data completa de la tabla variedades
    public function index(Request $request, Response $response): Response
    {
        $useCase = new GetAllVariedades($this->repo);
        $variedad = $useCase->execute();
        $response->getBody()->write(json_encode($variedad));
        return $response;
    }
}
