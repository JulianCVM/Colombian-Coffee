<?php

namespace App\Modules\TamanhoGrano\DTOs;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class TamanhoGranoDTO
{
    public function __construct(
        public readonly string $tamanho
    ) {
        $this->validateData($tamanho);
    }

    private function validateData(string $tamanho): void
    {
        try {
            $stringValidator = v::stringType()->notEmpty()->length(1, 255);

            $stringValidator->assert($tamanho);
        } catch (NestedValidationException $e) {
            throw new \InvalidArgumentException(
                'Error de validación: ' . $e->getFullMessage()
            );
        }
    }

    public function toArrayMapper(): array
    {
        return [
            'tamanho' => $this->tamanho
        ];
    }

    public static function fromArrayMapper(array $data): self
    {
        return new self(
            $data['tamanho'] ?? ''
        );
    }
}
