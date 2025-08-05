<?php

namespace App\Modules\Densidad\Controllers;

use App\Modules\Densidad\Domain\Repositories\DensidadRepositoryInterface;
use App\Modules\Densidad\DTOs\DensidadDTO;
use App\Modules\Densidad\UseCases\CreateDensidad;
use App\Modules\Densidad\UseCases\DeleteDensidad;
use App\Modules\Densidad\UseCases\GetAllDensidad;
use App\Modules\Densidad\UseCases\UpdateDensidad;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class DensidadController
{
    public function __construct(private DensidadRepositoryInterface $repo) {}


    public function index(Request $request, Response $response): Response
    {
        $useCase = new GetAllDensidad($this->repo);
        $result = $useCase->execute();
        $response->getBody()->write(json_encode($result));
        return $response;
    }

    public function store(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        $dto = DensidadDTO::fromArrayMapper($data);

        $useCase = new CreateDensidad($this->repo);
        $result = $useCase->execute($dto);
        if (!$result) {
            $response->getBody()->write(json_encode([
                "error" => "No se pudo crear la densidad",
            ]));
            return $response->withStatus(400);
        }
        $response->getBody()->write(json_encode($result));
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

        $dto = DensidadDTO::fromArrayMapper($data);

        $useCase = new UpdateDensidad($this->repo);
        $success = $useCase->execute($id, $dto);
        if (!$success) {
            $response->getBody()->write(json_encode([
                "error" => "No se pudo actualizar la densidad, densidad no registrada en la plataforma",
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

        $useCase = new DeleteDensidad($this->repo);
        $result = $useCase->execute($id);

        return $response->withStatus(200);
    }
}
