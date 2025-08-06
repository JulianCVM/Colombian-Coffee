<?php

namespace App\Modules\PotencialDeRendimiento\Controllers;

use App\Modules\PotencialDeRendimiento\Domain\Repositories\PotencialDeRendimientoRepositoryInterface;
use App\Modules\PotencialDeRendimiento\DTOs\PotencialDeRendimientoDTO;
use App\Modules\PotencialDeRendimiento\UseCases\CreatePotencialDeRendimiento;
use App\Modules\PotencialDeRendimiento\UseCases\DeletePotencialDeRendimiento;
use App\Modules\PotencialDeRendimiento\UseCases\GetAllPotencialDeRendimiento;
use App\Modules\PotencialDeRendimiento\UseCases\UpdatePotencialDeRendimiento;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class PotencialDeRendimientoController
{
    public function __construct(private PotencialDeRendimientoRepositoryInterface $repo) {}


    public function index(Request $request, Response $response): Response
    {
        $useCase = new GetAllPotencialDeRendimiento($this->repo);
        $result = $useCase->execute();
        $response->getBody()->write(json_encode($result));
        return $response;
    }

    public function store(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        $dto = PotencialDeRendimientoDTO::fromArrayMapper($data);

        $useCase = new CreatePotencialDeRendimiento($this->repo);
        $result = $useCase->execute($dto);
        if (!$result) {
            $response->getBody()->write(json_encode([
                "error" => "No se pudo crear el potencial de rendimiento",
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

        $dto = PotencialDeRendimientoDTO::fromArrayMapper($data);

        $useCase = new UpdatePotencialDeRendimiento($this->repo);
        $success = $useCase->execute($id, $dto);
        if (!$success) {
            $response->getBody()->write(json_encode([
                "error" => "No se pudo actualizar el potencial de rendimiento, potencial no registrada en la plataforma",
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

        $useCase = new DeletePotencialDeRendimiento($this->repo);
        $result = $useCase->execute($id);

        return $response->withStatus(200);
    }
}
