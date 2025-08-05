<?php

namespace App\Modules\CalidadAltitud\Controllers;

use App\Modules\CalidadAltitud\Domain\Repositories\CalidadAltitudRepositoryInterface;
use App\Modules\CalidadAltitud\DTOs\CalidadAltitudDTO;
use App\Modules\CalidadAltitud\UseCases\CreateCalidadAltitud;
use App\Modules\CalidadAltitud\UseCases\DeleteCalidadAltitud;
use App\Modules\CalidadAltitud\UseCases\GetAllCalidadAltitud;
use App\Modules\CalidadAltitud\UseCases\UpdateCalidadAltitud;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class CalidadAltitudController
{
    public function __construct(private CalidadAltitudRepositoryInterface $repo) {}


    public function index(Request $request, Response $response): Response
    {
        $useCase = new GetAllCalidadAltitud($this->repo);
        $result = $useCase->execute();
        $response->getBody()->write(json_encode($result));
        return $response;
    }

    public function store(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        $dto = CalidadAltitudDTO::fromArrayMapper($data);

        $useCase = new CreateCalidadAltitud($this->repo);
        $result = $useCase->execute($dto);
        if (!$result) {
            $response->getBody()->write(json_encode([
                "error" => "No se pudo crear la calidad altitud",
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

        $dto = CalidadAltitudDTO::fromArrayMapper($data);

        $useCase = new UpdateCalidadAltitud($this->repo);
        $success = $useCase->execute($id, $dto);
        if (!$success) {
            $response->getBody()->write(json_encode([
                "error" => "No se pudo actualizar la calidad altitud, no registrada en la plataforma",
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

        $useCase = new DeleteCalidadAltitud($this->repo);
        $result = $useCase->execute($id);

        return $response->withStatus(200);
    }
}
