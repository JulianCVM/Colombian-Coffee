<?php

namespace App\Modules\PotencialDeRendimiento\DTOs;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class PotencialDeRendimientoDTO
{
    public function __construct(
        public readonly string $potencial,
        public readonly int $condicion
    ) {
        $this->validateData($potencial, $condicion);
    }

    private function validateData(string $potencial, int $condicion): void
    {
        try {
            $stringValidator = v::stringType()->notEmpty()->length(1, 255);
            $intValidator = v::intType()->min(1);

            $stringValidator->assert($potencial);
            $intValidator->assert($condicion);
        } catch (NestedValidationException $e) {
            throw new \InvalidArgumentException(
                'Error de validación: ' . $e->getFullMessage()
            );
        }
    }

    public function toArrayMapper(): array
    {
        return [
            'potencial' => $this->potencial,
            'condicion' => $this->condicion,
        ];
    }

    public static function fromArrayMapper(array $data): self
    {
        return new self(
            $data['potencial'] ?? '',
            $data['condicion'] ?? 0
        );
    }
}
