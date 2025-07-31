<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Domain\Repositories\UserRepositoryInterface;
use App\DTOs\UserDTO;

class UserController
{
    public function __construct(private UserRepositoryInterface $repo) {}


    // hacer la logica de todo esto despues

    // public function createUser(Request $request, Response $response): Response {}

    // public function loginUser(Request $request, Response $response): Response {}

    // public function createAdmin(Request $request, Response $response): Response {}

    // public function loginAdmin(Request $request, Response $response): Response {}
}
