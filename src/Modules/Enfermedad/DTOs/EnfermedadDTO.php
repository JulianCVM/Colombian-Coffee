<?php

namespace App\Modules\Enfermedad\DTOs;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class EnfermedadDTO
{
    public function __construct(
        public readonly string $nombre,
        public readonly string $efectos,
        public readonly string $gravedad,
        public readonly string $tratamiento,
    ) {
        $this->validateData(
            $nombre,
            $efectos,
            $gravedad,
            $tratamiento
        );
    }

    private function validateData(
        string $nombre,
        string $efectos,
        string $gravedad,
        string $tratamiento
    ): void {
        try {
            $stringValidator = v::stringType()->notEmpty()->length(1, 255);

            $stringValidator->assert($nombre);
            $stringValidator->assert($efectos);
            $stringValidator->assert($gravedad);
            $stringValidator->assert($tratamiento);
        } catch (NestedValidationException $e) {
            throw new \InvalidArgumentException(
                'Error de validación: ' . $e->getFullMessage()
            );
        }
    }

    public function toArrayMapper(): array
    {
        return [
            'nombre' => $this->nombre,
            'efectos' => $this->efectos,
            'gravedad' => $this->gravedad,
            'tratamiento' => $this->tratamiento,
        ];
    }

    public static function fromArrayMapper(array $data): self
    {
        return new self(
            $data['nombre'] ?? '',
            $data['efectos'] ?? '',
            $data['gravedad'] ?? '',
            $data['tratamiento'] ?? ''
        );
    }
}
