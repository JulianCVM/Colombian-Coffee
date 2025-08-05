<?php

namespace App\Modules\Enfermedad\Controllers;

use App\Modules\Enfermedad\Domain\Repositories\EnfermedadRepositoryInterface;
use App\Modules\Enfermedad\DTOs\EnfermedadDTO;
use App\Modules\Enfermedad\UseCases\CreateEnfermedad;
use App\Modules\Enfermedad\UseCases\DeleteEnfermedad;
use App\Modules\Enfermedad\UseCases\GetAllEnfermedad;
use App\Modules\Enfermedad\UseCases\UpdateEnfermedad;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class EnfermedadController
{
    public function __construct(private EnfermedadRepositoryInterface $repo) {}


    public function index(Request $request, Response $response): Response
    {
        $useCase = new GetAllEnfermedad($this->repo);
        $result = $useCase->execute();
        $response->getBody()->write(json_encode($result));
        return $response;
    }

    public function store(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        $dto = EnfermedadDTO::fromArrayMapper($data);

        $useCase = new CreateEnfermedad($this->repo);
        $result = $useCase->execute($dto);
        if (!$result) {
            $response->getBody()->write(json_encode([
                "error" => "No se pudo crear la enfermedad",
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

        $dto = EnfermedadDTO::fromArrayMapper($data);

        $useCase = new UpdateEnfermedad($this->repo);
        $success = $useCase->execute($id, $dto);
        if (!$success) {
            $response->getBody()->write(json_encode([
                "error" => "No se pudo actualizar la enfermedad, enfermedad no registrada en la plataforma",
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

        $useCase = new DeleteEnfermedad($this->repo);
        $result = $useCase->execute($id);

        return $response->withStatus(200);
    }
}
