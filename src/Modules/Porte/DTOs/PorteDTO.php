<?php

namespace App\Modules\Porte\DTOs;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class PorteDTO
{
    public function __construct(
        public readonly string $porte,
        public readonly string $manejo_cultivo
    ) {
        $this->validateData($porte, $manejo_cultivo);
    }

    private function validateData(string $porte, string $manejo_cultivo): void
    {
        try {
            $stringValidator = v::stringType()->notEmpty()->length(1, 255);

            $stringValidator->assert($porte);
            $stringValidator->assert($manejo_cultivo);
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
            'manejo_cultivo' => $this->manejo_cultivo
        ];
    }

    public static function fromArrayMapper(array $data): self
    {
        return new self(
            $data['porte'] ?? '',
            $data['manejo_cultivo'] ?? ''
        );
    }
}
