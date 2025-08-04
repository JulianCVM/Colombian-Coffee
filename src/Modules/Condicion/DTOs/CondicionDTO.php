<?php

namespace App\Modules\Condicion\DTOs;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class CondicionDTO
{
    public function __construct(
        public readonly string $genetica,
        public readonly string $clima,
        public readonly string $suelo,
        public readonly string $practicas_cultivo,
        public readonly string $temperatura,
    ) {
        $this->validateData(
            $genetica,
            $clima,
            $suelo,
            $practicas_cultivo,
            $temperatura
        );
    }

    private function validateData(
        string $genetica,
        string $clima,
        string $suelo,
        string $practicas_cultivo,
        string $temperatura
    ): void {
        try {
            $stringValidator = v::stringType()->notEmpty()->length(1, 255);

            $stringValidator->assert($genetica);
            $stringValidator->assert($clima);
            $stringValidator->assert($suelo);
            $stringValidator->assert($practicas_cultivo);
            $stringValidator->assert($temperatura);
        } catch (NestedValidationException $e) {
            throw new \InvalidArgumentException(
                'Error de validación: ' . $e->getFullMessage()
            );
        }
    }

    public function toArrayMapper(): array
    {
        return [
            'genetica' => $this->genetica,
            'clima' => $this->clima,
            'suelo' => $this->suelo,
            'practicas_cultivo' => $this->practicas_cultivo,
            'temperatura' => $this->temperatura,
        ];
    }

    public static function fromArrayMapper(array $data): self
    {
        return new self(
            $data['genetica'] ?? '',
            $data['clima'] ?? '',
            $data['suelo'] ?? '',
            $data['practicas_cultivo'] ?? '',
            $data['temperatura'] ?? ''
        );
    }
}
