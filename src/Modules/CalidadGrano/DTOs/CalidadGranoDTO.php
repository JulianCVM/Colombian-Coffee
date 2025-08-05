<?php

namespace App\Modules\CalidadGrano\DTOs;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class CalidadGranoDTO
{
    public function __construct(
        public readonly string $calidad,
        public readonly string $aroma,
        public readonly string $sabor,
        public readonly int $densidad,
        public readonly string $humedad,
        public readonly string $tueste,
        public readonly int $origen
    ) {
        $this->validateData($calidad, $aroma, $sabor, $densidad, $humedad, $tueste, $origen);
    }

    private function validateData(
        string $calidad,
        string $aroma,
        string $sabor,
        int $densidad,
        string $humedad,
        string $tueste,
        int $origen
    ): void {
        try {
            $stringValidator = v::stringType()->notEmpty()->length(1, 255);
            $intValidator = v::intType()->min(1);

            $stringValidator->assert($calidad);
            $stringValidator->assert($aroma);
            $stringValidator->assert($sabor);
            $intValidator->assert($densidad);
            $stringValidator->assert($humedad);
            $stringValidator->assert($tueste);
            $intValidator->assert($origen);
        } catch (NestedValidationException $e) {
            throw new \InvalidArgumentException(
                'Error de validación: ' . $e->getFullMessage()
            );
        }
    }

    public function toArrayMapper(): array
    {
        return [
            'calidad' => $this->calidad,
            'aroma' => $this->aroma,
            'sabor' => $this->sabor,
            'densidad' => $this->densidad,
            'humedad' => $this->humedad,
            'tueste' => $this->tueste,
            'origen' => $this->origen,
        ];
    }

    public static function fromArrayMapper(array $data): self
    {
        return new self(
            $data['calidad'] ?? '',
            $data['aroma'] ?? '',
            $data['sabor'] ?? '',
            $data['densidad'] ?? 0,
            $data['humedad'] ?? '',
            $data['tueste'] ?? '',
            $data['origen'] ?? 0
        );
    }
}
