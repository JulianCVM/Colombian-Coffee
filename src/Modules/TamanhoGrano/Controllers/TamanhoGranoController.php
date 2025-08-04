<?php

namespace App\Modules\TamanhoGrano\Controllers;

use App\Modules\TamanhoGrano\Domain\Repositories\TamanhoGranoRepositoryInterface;
use App\Modules\TamanhoGrano\DTOs\TamanhoGranoDTO;
use App\Modules\TamanhoGrano\UseCases\CreateTamanhoGrano;
use App\Modules\TamanhoGrano\UseCases\DeleteTamanhoGrano;
use App\Modules\TamanhoGrano\UseCases\GetAllTamanhoGrano;
use App\Modules\TamanhoGrano\UseCases\UpdateTamanhoGrano;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class TamanhoGranoController
{
    public function __construct(private TamanhoGranoRepositoryInterface $repo) {}


    public function index(Request $request, Response $response): Response
    {
        $useCase = new GetAllTamanhoGrano($this->repo);
        $result = $useCase->execute();
        $response->getBody()->write(json_encode($result));
        return $response;
    }

    public function store(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        $dto = TamanhoGranoDTO::fromArrayMapper($data);

        $useCase = new CreateTamanhoGrano($this->repo);
        $result = $useCase->execute($dto);
        if (!$result) {
            $response->getBody()->write(json_encode([
                "error" => "No se pudo crear el tamanho del grano hermao caralho",
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

        $dto = TamanhoGranoDTO::fromArrayMapper($data);

        $useCase = new UpdateTamanhoGrano($this->repo);
        $success = $useCase->execute($id, $dto);
        if (!$success) {
            $response->getBody()->write(json_encode([
                "error" => "No se pudo actualizar el tamanho del grano, tamanho no registrada en la plataforma",
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

        $useCase = new DeleteTamanhoGrano($this->repo);
        $result = $useCase->execute($id);

        return $response->withStatus(200);
    }
}
