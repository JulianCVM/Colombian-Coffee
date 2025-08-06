<?php

namespace App\Modules\User\DTOs;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class LoginDTO
{
    public function __construct(
        public readonly string $email,
        public readonly string $password
    ) {
        $this->validate($email, $password);
    }

    private function validate(string $email, string $password): void
    {
        try {
            v::email()
                ->setName('Correo electrónico')
                ->assert($email);

            v::stringType()
                ->length(8, 100)
                ->setName('Contraseña')
                ->assert($password);
        } catch (NestedValidationException $e) {
            throw new \InvalidArgumentException('Error de validación: ' . $e->getFullMessage());
        }
    }
    public function toArray(): array
    {
        return [
            "email" => $this->email,
            "password" => $this->password,
        ];
    }
    public static function fromArrayMapper(array $data): self
    {
        return new self(
            $data['email'] ?? '',
            $data['password'] ?? ''
        );
    }
}
