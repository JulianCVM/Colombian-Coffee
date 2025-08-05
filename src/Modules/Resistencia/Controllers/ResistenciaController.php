<?php

namespace App\Modules\Resistencia\Controllers;

use App\Modules\Resistencia\Domain\Repositories\ResistenciaRepositoryInterface;
use App\Modules\Resistencia\DTOs\ResistenciaDTO;
use App\Modules\Resistencia\UseCases\CreateResistencia;
use App\Modules\Resistencia\UseCases\DeleteResistencia;
use App\Modules\Resistencia\UseCases\GetAllResistencia;
use App\Modules\Resistencia\UseCases\UpdateResistencia;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class ResistenciaController
{
    public function __construct(private ResistenciaRepositoryInterface $repo) {}


    public function index(Request $request, Response $response): Response
    {
        $useCase = new GetAllResistencia($this->repo);
        $result = $useCase->execute();
        $response->getBody()->write(json_encode($result));
        return $response;
    }

    public function store(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        $dto = ResistenciaDTO::fromArrayMapper($data);

        $useCase = new CreateResistencia($this->repo);
        $result = $useCase->execute($dto);
        if (!$result) {
            $response->getBody()->write(json_encode([
                "error" => "No se pudo crear la resistencia",
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

        $dto = ResistenciaDTO::fromArrayMapper($data);

        $useCase = new UpdateResistencia($this->repo);
        $success = $useCase->execute($id, $dto);
        if (!$success) {
            $response->getBody()->write(json_encode([
                "error" => "No se pudo actualizar la resistencia, resistencia no registrada en la plataforma",
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

        $useCase = new DeleteResistencia($this->repo);
        $result = $useCase->execute($id);

        return $response->withStatus(200);
    }
}
