<?php

namespace App\Modules\Porte\Controllers;

use App\Modules\Porte\Domain\Repositories\PorteRepositoryInterface;
use App\Modules\Porte\DTOs\PorteDTO;
use App\Modules\Porte\UseCases\CreatePorte;
use App\Modules\Porte\UseCases\DeletePorte;
use App\Modules\Porte\UseCases\GetAllPorte;
use App\Modules\Porte\UseCases\UpdatePorte;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class PorteController
{
    public function __construct(private PorteRepositoryInterface $repo) {}


    public function index(Request $request, Response $response): Response
    {
        $useCase = new GetAllPorte($this->repo);
        $result = $useCase->execute();
        $response->getBody()->write(json_encode($result));
        return $response;
    }

    public function store(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        $dto = PorteDTO::fromArrayMapper($data);

        $useCase = new CreatePorte($this->repo);
        $result = $useCase->execute($dto);
        if (!$result) {
            $response->getBody()->write(json_encode([
                "error" => "No se pudo crear el porte",
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

        $dto = PorteDTO::fromArrayMapper($data);

        $useCase = new UpdatePorte($this->repo);
        $success = $useCase->execute($id, $dto);
        if (!$success) {
            $response->getBody()->write(json_encode([
                "error" => "No se pudo actualizar el porte, porte no registrada en la plataforma",
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

        $useCase = new DeletePorte($this->repo);
        $result = $useCase->execute($id);

        return $response->withStatus(200);
    }
}
