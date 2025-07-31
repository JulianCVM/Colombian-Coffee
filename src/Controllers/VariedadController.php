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
        $result = $useCase->execute();

        // Si viene una Collection/Model de Eloquent, la volvemos arreglo:
        if (is_object($result) && method_exists($result, 'toArray')) {
            $result = $result->toArray();
        }

        $response->getBody()->write(json_encode($result, JSON_UNESCAPED_UNICODE));
        return $response->withHeader('Content-Type', 'application/json');
    }
}
