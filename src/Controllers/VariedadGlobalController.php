<?php

namespace App\Controllers;

use App\Domain\Repositories\VariedadGlobalRepositoryInterface;
use App\UseCases\obtenerTodoVariedad;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class VariedadGlobalController
{
    public function __construct(private VariedadGlobalRepositoryInterface $repo)
    {
        error_log("=== VariedadGlobalController CONSTRUCTOR ===");
    }

    public function index(Request $request, Response $response): Response
    {
        error_log("=== VariedadGlobalController::index INICIADO ===");

        try {
            error_log("1. Antes de crear UseCase");
            $useCase = new obtenerTodoVariedad($this->repo);

            error_log("2. Antes de execute()");
            $variedad = $useCase->execute();

            error_log("3. Datos obtenidos: " . (is_array($variedad) ? count($variedad) . " elementos" : "null"));

            $jsonData = json_encode($variedad, JSON_UNESCAPED_UNICODE);

            if ($jsonData === false) {
                throw new \Exception('Error JSON: ' . json_last_error_msg());
            }

            error_log("4. JSON generado exitosamente");

            $response->getBody()->write($jsonData);
            return $response->withHeader('Content-Type', 'application/json');
        } catch (\Throwable $e) {
            error_log("ERROR en VariedadGlobalController: " . $e->getMessage());
            error_log("FILE: " . $e->getFile() . " LINE: " . $e->getLine());

            $error = ['error' => $e->getMessage()];
            $response->getBody()->write(json_encode($error));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(500);
        }
    }
}
