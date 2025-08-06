<?php

namespace App\Modules\Variedad\Controllers;

use App\Modules\Variedad\Domain\Repositories\VariedadRepositoryInterface;
use App\Modules\Variedad\DTOs\VariedadDTO;
use App\Modules\Variedad\UseCases\CreateVariedad;
use App\Modules\Variedad\UseCases\DeleteVariedad;
use App\Modules\Variedad\UseCases\UpdateVariedad;
use App\Modules\Variedad\UseCases\GetAllVariedades;
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

    public function store(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        // se parsea la data de array a DTO
        $dto = VariedadDTO::fromArrayMapper($data);

        // se pasa el dto al caso de uso
        $useCase = new CreateVariedad($this->repo);
        $variedad = $useCase->execute($dto);
        if (!$variedad) {
            $response->getBody()->write(json_encode([
                "error" => "No se pudo crear la variedad",
            ]));
            return $response->withStatus(400);
        }
        $response->getBody()->write(json_encode($variedad));
        return $response->withStatus(201);
    }


    public function update(Request $request, Response $response, array $args): Response
    {
        $id = isset($args['id']) ? (int)$args['id'] : null;

        if ($id === null) {
            $response->getBody()->write(json_encode(['error' => 'ID no proporcionado']));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        $data = $request->getParsedBody();

        $dto = VariedadDTO::fromArrayMapper($data);

        $useCase = new UpdateVariedad($this->repo);
        $success = $useCase->execute($id, $dto);
        if (!$success) {
            $response->getBody()->write(json_encode([
                "error" => "No se pudo actualizar la variedad, variedad no registrada en la plataforma",
            ]));
            return $response->withStatus(404);
        }
        return $response->withStatus(200);
    }


    public function destroy(Request $request, Response $response, array $args): Response
    {
        $id = isset($args['id']) ? (int)$args['id'] : null;

        if ($id === null) {
            $response->getBody()->write(json_encode(['error' => 'ID no proporcionado']));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }

        $useCase = new DeleteVariedad($this->repo);
        $variedad = $useCase->execute($id);

        return $response->withStatus(200);
    }
}
