<?php

namespace App\DTOs;

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

class LoginDTO
{
    public readonly string $email;
    public readonly string $password;

    public function __construct(string $email, string $password)
    {
        try {
            v::email()->assert($email);
            v::stringType()->length(1, 100)->assert($password); // Cambiado de 8 a 1 para permitir passwords más cortos
        } catch (NestedValidationException $e) {
            throw new \InvalidArgumentException($e->getFullMessage());
        }

        $this->email = $email;
        $this->password = $password;
    }
}