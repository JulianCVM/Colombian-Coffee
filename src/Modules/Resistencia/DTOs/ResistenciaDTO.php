<?php

namespace App\Modules\Resistencia\DTOs;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class ResistenciaDTO
{
    public function __construct(
        public readonly string $tipo,
        public readonly int $calidad_grano,
        public readonly int $enfermedad
    ) {
        $this->validateData($tipo, $calidad_grano, $enfermedad);
    }

    private function validateData(string $tipo, int $calidad_grano, int $enfermedad): void
    {
        try {
            $stringValidator = v::stringType()->notEmpty()->length(1, 255);
            $intValidator = v::intType()->min(1);

            $stringValidator->assert($tipo);
            $intValidator->assert($calidad_grano);
            $intValidator->assert($enfermedad);
        } catch (NestedValidationException $e) {
            throw new \InvalidArgumentException(
                'Error de validación: ' . $e->getFullMessage()
            );
        }
    }

    public function toArrayMapper(): array
    {
        return [
            'tipo' => $this->tipo,
            'calidad_grano' => $this->calidad_grano,
            'enfermedad' => $this->enfermedad,
        ];
    }

    public static function fromArrayMapper(array $data): self
    {
        return new self(
            $data['tipo'] ?? '',
            $data['calidad_grano'] ?? 0,
            $data['enfermedad'] ?? 0
        );
    }
}
