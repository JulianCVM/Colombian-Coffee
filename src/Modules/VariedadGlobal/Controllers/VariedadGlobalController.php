<?php

namespace App\Modules\VariedadGlobal\Controllers;

use App\Modules\VariedadGlobal\Domain\Repositories\VariedadGlobalRepositoryInterface;
use App\Modules\VariedadGlobal\UseCases\obtenerTodoVariedad;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class VariedadGlobalController
{
        public function __construct(private VariedadGlobalRepositoryInterface $repo) {}


        public function index(Request $request, Response $response): Response
        {
                $useCase = new obtenerTodoVariedad($this->repo);
                $variedad = $useCase->execute();
                $response->getBody()->write(json_encode($variedad, JSON_PRETTY_PRINT, 50));
                return $response;
        }
}
