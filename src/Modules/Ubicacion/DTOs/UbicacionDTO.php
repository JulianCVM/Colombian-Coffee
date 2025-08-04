<?php

namespace App\Modules\Ubicacion\DTOs;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class UbicacionDTO
{
    public function __construct(
        public readonly string $departamento,
        public readonly string $clima,
        public readonly string $suelo,
        public readonly string $altitud,
        public readonly string $temperatura,
        public readonly string $practica_cultivo,
    ) {
        $this->validateData(
            $departamento,
            $clima,
            $suelo,
            $altitud,
            $temperatura,
            $practica_cultivo
        );
    }

    private function validateData(
        string $departamento,
        string $clima,
        string $suelo,
        string $altitud,
        string $temperatura,
        string $practica_cultivo
    ): void {
        try {
            $validator = v::stringType()->notEmpty()->length(1, 255);

            $validator->assert($departamento);
            $validator->assert($clima);
            $validator->assert($suelo);
            $validator->assert($altitud);
            $validator->assert($temperatura);
            $validator->assert($practica_cultivo);
        } catch (NestedValidationException $e) {
            throw new \InvalidArgumentException(
                'Error de validación: ' . $e->getFullMessage()
            );
        }
    }

    public function toArrayMapper(): array
    {
        return [
            'departamento' => $this->departamento,
            'clima' => $this->clima,
            'suelo' => $this->suelo,
            'altitud' => $this->altitud,
            'temperatura' => $this->temperatura,
            'practica_cultivo' => $this->practica_cultivo,
        ];
    }

    public static function fromArrayMapper(array $data): self
    {
        return new self(
            $data['departamento'] ?? '',
            $data['clima'] ?? '',
            $data['suelo'] ?? '',
            $data['altitud'] ?? '',
            $data['temperatura'] ?? '',
            $data['practica_cultivo'] ?? ''
        );
    }
}
