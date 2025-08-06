<?php

namespace App\Modules\Imagenes\Controllers;

use App\Modules\Imagenes\Domain\Repositories\ImagenRepositoryInterface;
use App\Modules\Imagenes\DTOs\ImagenDTO;
use App\Modules\Imagenes\UseCases\CreateImagen;
use App\Modules\Imagenes\UseCases\GetAllImagen;
use App\Modules\Imagenes\UseCases\UpdateImagen;
use App\Modules\TamanhoGrano\UseCases\DeleteTamanhoGrano;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class ImagenController
{
    public function __construct(private ImagenRepositoryInterface $repo) {}


    public function index(Request $request, Response $response): Response
    {
        $useCase = new GetAllImagen($this->repo);
        $result = $useCase->execute();
        $response->getBody()->write(json_encode($result));
        return $response;
    }

    public function store(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        $dto = ImagenDTO::fromArrayMapper($data);

        $useCase = new CreateImagen($this->repo);
        $result = $useCase->execute($dto);
        if (!$result) {
            $response->getBody()->write(json_encode([
                "error" => "No se pudo crear la imagen",
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

        $dto = ImagenDTO::fromArrayMapper($data);

        $useCase = new UpdateImagen($this->repo);
        $success = $useCase->execute($id, $dto);
        if (!$success) {
            $response->getBody()->write(json_encode([
                "error" => "No se pudo actualizar la imagen, imagen no registrada en la plataforma",
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
