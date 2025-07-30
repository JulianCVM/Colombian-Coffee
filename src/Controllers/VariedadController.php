<?php

namespace App\Controllers;

use App\Domain\Repositories\VariedadRepositoryInterface;
use App\UseCases\GetAllVariedades;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class VariedadController
{
    public function __construct(private VariedadRepositoryInterface $repo) {}

    public function index(Request $request, Response $response): Response
    {
        $useCase = new GetAllVariedades($this->repo);
        $variedad = $useCase->execute();
        $response->getBody()->write(json_encode($variedad));
        return $response;
    }
}
