<?php

namespace App\Controllers;

use App\Domain\Repositories\VariedadGlobalRepositoryInterface;
use App\UseCases\obtenerTodoVariedad;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class VariedadGlobalController
{
    public function __construct(private VariedadGlobalRepositoryInterface $repo) {}


    public function index(Request $request, Response $response): Response
    {
        $useCase = new obtenerTodoVariedad($this->repo);
        $variedad = $useCase->execute();
        $response->getBody()->write(json_encode($variedad));
        return $response;
    }
}
