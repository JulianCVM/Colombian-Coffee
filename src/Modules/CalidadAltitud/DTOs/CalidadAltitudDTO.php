<?php

namespace App\Modules\CalidadAltitud\DTOs;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class CalidadAltitudDTO
{
    public function __construct(
        public readonly int $ubicacion,
        public readonly string $calidad
    ) {
        $this->validateData($ubicacion, $calidad);
    }

    private function validateData(int $ubicacion, string $calidad): void
    {
        try {
            $intValidator = v::intType()->min(1);
            $stringValidator = v::stringType()->notEmpty()->length(1, 255);

            $intValidator->assert($ubicacion);
            $stringValidator->assert($calidad);
        } catch (NestedValidationException $e) {
            throw new \InvalidArgumentException(
                'Error de validación: ' . $e->getFullMessage()
            );
        }
    }

    public function toArrayMapper(): array
    {
        return [
            'ubicacion' => $this->ubicacion,
            'calidad' => $this->calidad,
        ];
    }

    public static function fromArrayMapper(array $data): self
    {
        return new self(
            $data['ubicacion'] ?? 0,
            $data['calidad'] ?? ''
        );
    }
}
