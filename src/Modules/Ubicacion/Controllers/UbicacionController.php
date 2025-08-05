<?php

namespace App\Modules\Ubicacion\Controllers;

use App\Modules\Ubicacion\Domain\Repositories\UbicacionRepositoryInterface;
use App\Modules\Ubicacion\DTOs\UbicacionDTO;
use App\Modules\Ubicacion\UseCases\CreateUbicacion;
use App\Modules\Ubicacion\UseCases\DeleteUbicacion;
use App\Modules\Ubicacion\UseCases\GetAllUbicacion;
use App\Modules\Ubicacion\UseCases\UpdateUbicacion;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class UbicacionController
{
    public function __construct(private UbicacionRepositoryInterface $repo) {}


    public function index(Request $request, Response $response): Response
    {
        $useCase = new GetAllUbicacion($this->repo);
        $result = $useCase->execute();
        $response->getBody()->write(json_encode($result));
        return $response;
    }

    public function store(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        $dto = UbicacionDTO::fromArrayMapper($data);

        $useCase = new CreateUbicacion($this->repo);
        $result = $useCase->execute($dto);
        if (!$result) {
            $response->getBody()->write(json_encode([
                "error" => "No se pudo crear la ubicacion",
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

        $dto = UbicacionDTO::fromArrayMapper($data);

        $useCase = new UpdateUbicacion($this->repo);
        $success = $useCase->execute($id, $dto);
        if (!$success) {
            $response->getBody()->write(json_encode([
                "error" => "No se pudo actualizar la ubicacion, ubicacion no registrada en la plataforma",
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

        $useCase = new DeleteUbicacion($this->repo);
        $result = $useCase->execute($id);

        return $response->withStatus(200);
    }
}
