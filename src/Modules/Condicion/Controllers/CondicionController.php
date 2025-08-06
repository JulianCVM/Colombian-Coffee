<?php

namespace App\Modules\Condicion\Controllers;

use App\Modules\Condicion\Domain\Repositories\CondicionRepositoryInterface;
use App\Modules\Condicion\DTOs\CondicionDTO;
use App\Modules\Condicion\UseCases\CreateCondicion;
use App\Modules\Condicion\UseCases\DeleteCondicion;
use App\Modules\Condicion\UseCases\GetAllCondicion;
use App\Modules\Condicion\UseCases\UpdateCondicion;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class CondicionController
{
    public function __construct(private CondicionRepositoryInterface $repo) {}


    public function index(Request $request, Response $response): Response
    {
        $useCase = new GetAllCondicion($this->repo);
        $result = $useCase->execute();
        $response->getBody()->write(json_encode($result));
        return $response;
    }

    public function store(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        $dto = CondicionDTO::fromArrayMapper($data);

        $useCase = new CreateCondicion($this->repo);
        $result = $useCase->execute($dto);
        if (!$result) {
            $response->getBody()->write(json_encode([
                "error" => "No se pudo crear la condicion",
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

        $dto = CondicionDTO::fromArrayMapper($data);

        $useCase = new UpdateCondicion($this->repo);
        $success = $useCase->execute($id, $dto);
        if (!$success) {
            $response->getBody()->write(json_encode([
                "error" => "No se pudo actualizar la condicion, condicion no registrada en la plataforma",
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

        $useCase = new DeleteCondicion($this->repo);
        $result = $useCase->execute($id);

        return $response->withStatus(200);
    }
}
