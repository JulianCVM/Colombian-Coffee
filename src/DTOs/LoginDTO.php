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
            v::stringType()->length(8, 100)->assert($password);
        } catch (NestedValidationException $e) {
            throw new \InvalidArgumentException($e->getFullMessage());
        }

        $this->email = $email;
        $this->password = $password;
    }
}
