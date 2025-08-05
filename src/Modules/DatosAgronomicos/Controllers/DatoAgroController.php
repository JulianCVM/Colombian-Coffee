<?php

namespace App\Modules\DatosAgronomicos\Controllers;

use App\Modules\DatosAgronomicos\Domain\Repositories\DatoAgroRepositoryInterface;
use App\Modules\DatosAgronomicos\DTOs\DatoAgroDTO;
use App\Modules\DatosAgronomicos\UseCases\CreateDatoAgro;
use App\Modules\DatosAgronomicos\UseCases\DeleteDatoAgro;
use App\Modules\DatosAgronomicos\UseCases\GetAllDatoAgro;
use App\Modules\DatosAgronomicos\UseCases\UpdateDatoAgro;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class DatoAgroController
{
    public function __construct(private DatoAgroRepositoryInterface $repo) {}


    public function index(Request $request, Response $response): Response
    {
        $useCase = new GetAllDatoAgro($this->repo);
        $result = $useCase->execute();
        $response->getBody()->write(json_encode($result));
        return $response;
    }

    public function store(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        $dto = DatoAgroDTO::fromArrayMapper($data);

        $useCase = new CreateDatoAgro($this->repo);
        $result = $useCase->execute($dto);
        if (!$result) {
            $response->getBody()->write(json_encode([
                "error" => "No se pudo crear el dato agronomico",
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

        $dto = DatoAgroDTO::fromArrayMapper($data);

        $useCase = new UpdateDatoAgro($this->repo);
        $success = $useCase->execute($id, $dto);
        if (!$success) {
            $response->getBody()->write(json_encode([
                "error" => "No se pudo actualizar el dato agrnomico, no registrado en la plataforma",
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

        $useCase = new DeleteDatoAgro($this->repo);
        $result = $useCase->execute($id);

        return $response->withStatus(200);
    }
}
