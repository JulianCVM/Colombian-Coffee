<?php

namespace App\Modules\HistoriaLinaje\Controllers;

use App\Modules\HistoriaLinaje\Domain\Repositories\HistoriaLinajeRepositoryInterface;
use App\Modules\HistoriaLinaje\DTOs\HistoriaLinajeDTO;
use App\Modules\HistoriaLinaje\UseCases\CreateHistoriaLinaje;
use App\Modules\HistoriaLinaje\UseCases\DeleteHistoriaLinaje;
use App\Modules\HistoriaLinaje\UseCases\GetAllHistoriaLinaje;
use App\Modules\HistoriaLinaje\UseCases\UpdateHistoriaLinaje;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class HistoriaLinajeController
{
    public function __construct(private HistoriaLinajeRepositoryInterface $repo) {}


    public function index(Request $request, Response $response): Response
    {
        $useCase = new GetAllHistoriaLinaje($this->repo);
        $historia = $useCase->execute();
        $response->getBody()->write(json_encode($historia));
        return $response;
    }

    public function store(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        $dto = HistoriaLinajeDTO::fromArrayMapper($data);

        $useCase = new CreateHistoriaLinaje($this->repo);
        $historia = $useCase->execute($dto);
        if (!$historia) {
            $response->getBody()->write(json_encode([
                "error" => "No se pudo crear la historia",
            ]));
            return $response->withStatus(400);
        }
        $response->getBody()->write(json_encode($historia));
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

        $dto = HistoriaLinajeDTO::fromArrayMapper($data);

        $useCase = new UpdateHistoriaLinaje($this->repo);
        $success = $useCase->execute($id, $dto);
        if (!$success) {
            $response->getBody()->write(json_encode([
                "error" => "No se pudo actualizar la historia, historia no registrada en la plataforma",
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

        $useCase = new DeleteHistoriaLinaje($this->repo);
        $result = $useCase->execute($id);

        return $response->withStatus(200);
    }
}
