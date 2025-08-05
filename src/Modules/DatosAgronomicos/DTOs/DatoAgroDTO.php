<?php

namespace App\Modules\DatosAgronomicos\DTOs;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class DatoAgroDTO
{
    public function __construct(
        public readonly string $tiempo_cosecha,
        public readonly string $maduracion,
        public readonly string $nutricion,
        public readonly int $densidad_de_siembra
    ) {
        $this->validateData($tiempo_cosecha, $maduracion, $nutricion, $densidad_de_siembra);
    }

    private function validateData(string $tiempo_cosecha, string $maduracion, string $nutricion, int $densidad_de_siembra): void
    {
        try {
            $stringValidator = v::stringType()->notEmpty()->length(1, 255);
            $intValidator = v::intType()->min(1);

            $stringValidator->assert($tiempo_cosecha);
            $stringValidator->assert($maduracion);
            $stringValidator->assert($nutricion);
            $intValidator->assert($densidad_de_siembra);
        } catch (NestedValidationException $e) {
            throw new \InvalidArgumentException(
                'Error de validación: ' . $e->getFullMessage()
            );
        }
    }

    public function toArrayMapper(): array
    {
        return [
            'tiempo_cosecha' => $this->tiempo_cosecha,
            'maduracion' => $this->maduracion,
            'nutricion' => $this->nutricion,
            'densidad_de_siembra' => $this->densidad_de_siembra,
        ];
    }

    public static function fromArrayMapper(array $data): self
    {
        return new self(
            $data['tiempo_cosecha'] ?? '',
            $data['maduracion'] ?? '',
            $data['nutricion'] ?? '',
            $data['densidad_de_siembra'] ?? 0
        );
    }
}
