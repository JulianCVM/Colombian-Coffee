<?php

namespace App\Modules\Densidad\DTOs;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class DensidadDTO
{
    public function __construct(
        public readonly int $porte,
        public readonly int $tamanho_grano,
        public readonly int $valor_densidad,
    ) {
        $this->validateData(
            $porte,
            $tamanho_grano,
            $valor_densidad
        );
    }

    private function validateData(
        int $porte,
        int $tamanho_grano,
        int $valor_densidad
    ): void {
        try {
            $intValidator = v::intType()->positive();

            $intValidator->assert($porte);
            $intValidator->assert($tamanho_grano);
            $intValidator->assert($valor_densidad);
        } catch (NestedValidationException $e) {
            throw new \InvalidArgumentException(
                'Error de validación: ' . $e->getFullMessage()
            );
        }
    }

    public function toArrayMapper(): array
    {
        return [
            'porte' => $this->porte,
            'tamanho_grano' => $this->tamanho_grano,
            'valor_densidad' => $this->valor_densidad,
        ];
    }

    public static function fromArrayMapper(array $data): self
    {
        return new self(
            (int) ($data['porte'] ?? 0),
            (int) ($data['tamanho_grano'] ?? 0),
            (int) ($data['valor_densidad'] ?? 0),
        );
    }
}
