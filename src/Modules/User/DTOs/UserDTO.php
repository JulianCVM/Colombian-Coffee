<?php

namespace App\Modules\User\DTOs;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class UserDTO
{
    private readonly string $password;

    public function __construct(
        public readonly string $nombre,
        public readonly string $email,
        string $password,
        public readonly string $rol = 'user'
    ) {
        $this->validate($nombre, $email, $password, $rol);
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    private function validate(string $nombre, string $email, string $password, string $rol): void
    {
        try {
            v::stringType()
                ->length(2, 50)
                ->setName('Nombre')
                ->assert($nombre);

            v::email()
                ->setName('Correo electrónico')
                ->assert($email);

            v::stringType()
                ->length(8, 100)
                ->regex('/[!@#$%^&*()\-_=+{};:,<.>]/') // al menos un caracter especial
                ->regex('/[0-9]/') // al menos un número
                ->setName('Contraseña')
                ->assert($password);

            v::in(['user', 'admin'])
                ->setName('Rol')
                ->assert($rol);
        } catch (NestedValidationException $e) {
            throw new \InvalidArgumentException('Error de validación: ' . $e->getFullMessage());
        }
    }

    public function toArray(): array
    {
        return [
            "nombre" => $this->nombre,
            "email" => $this->email,
            "password" => $this->password,
            "rol" => $this->rol
        ];
    }

    public static function fromArrayMapper(array $data): self
    {
        return new self(
            $data['nombre'] ?? '',
            $data['email'] ?? '',
            $data['password'] ?? '',
            $data['rol'] ?? 'user'
        );
    }
}
