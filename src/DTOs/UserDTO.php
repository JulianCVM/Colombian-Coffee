<?php

namespace App\DTOs;

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

class UserDTO
{
    public readonly string $nombre;
    public readonly string $email;
    public readonly string $password;
    public readonly string $rol;

    public function __construct(string $nombre, string $email, string $password, string $rol = 'user')
    {
        try {
            v::stringType()->length(2, 100)->assert($nombre);
            v::email()->assert($email);
            v::stringType()->length(1, 100)->assert($password);
            v::in(['admin', 'user'])->assert($rol);
        } catch (NestedValidationException $e) {
            throw new \InvalidArgumentException($e->getFullMessage());
        }

        $this->nombre = $nombre;
        $this->email = $email;
        $this->password = $password;
        $this->rol = $rol;
    }
}