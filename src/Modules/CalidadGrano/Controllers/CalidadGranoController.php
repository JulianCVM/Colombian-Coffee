<?php

namespace App\Modules\CalidadGrano\Controllers;

use App\Modules\CalidadGrano\Domain\Repositories\CalidadGranoRepositoryInterface;
use App\Modules\CalidadGrano\DTOs\CalidadGranoDTO;
use App\Modules\CalidadGrano\UseCases\CreateCalidadGrado;
use App\Modules\CalidadGrano\UseCases\DeleteCalidadGrado;
use App\Modules\CalidadGrano\UseCases\GetAllCalidadGrado;
use App\Modules\CalidadGrano\UseCases\UpdateCalidadGrado;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class CalidadGranoController
{
    public function __construct(private CalidadGranoRepositoryInterface $repo) {}


    public function index(Request $request, Response $response): Response
    {
        $useCase = new GetAllCalidadGrado($this->repo);
        $result = $useCase->execute();
        $response->getBody()->write(json_encode($result));
        return $response;
    }

    public function store(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        $dto = CalidadGranoDTO::fromArrayMapper($data);

        $useCase = new CreateCalidadGrado($this->repo);
        $result = $useCase->execute($dto);
        if (!$result) {
            $response->getBody()->write(json_encode([
                "error" => "No se pudo crear la calidad grano",
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

        $dto = CalidadGranoDTO::fromArrayMapper($data);

        $useCase = new UpdateCalidadGrado($this->repo);
        $success = $useCase->execute($id, $dto);
        if (!$success) {
            $response->getBody()->write(json_encode([
                "error" => "No se pudo actualizar la calidad grano, no registrada en la plataforma",
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

        $useCase = new DeleteCalidadGrado($this->repo);
        $result = $useCase->execute($id);

        return $response->withStatus(200);
    }
}
