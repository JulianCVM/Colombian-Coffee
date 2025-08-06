<?php

namespace App\Modules\HistoriaLinaje\DTOs;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;


class HistoriaLinajeDTO
{

    public function __construct(
        public readonly string $obtenor,
        public readonly string $familia,
        public readonly string $grupo,
    ) {
        $this->validateData(
            $obtenor,
            $familia,
            $grupo
        );
    }

    private function validateData(
        string $obtenor,
        string $familia,
        string $grupo
    ): void {
        try {
            $obtenorValidator = v::stringType()->notEmpty()->length(1, 255);
            $familiaValidator = v::stringType()->notEmpty()->length(1, 255);
            $grupoValidator = v::stringType()->notEmpty()->length(1, 255);

            $obtenorValidator->assert($obtenor);
            $familiaValidator->assert($familia);
            $grupoValidator->assert($grupo);
        } catch (NestedValidationException $e) {
            throw new \InvalidArgumentException(
                'Error de validación: ' . $e->getFullMessage()
            );
        }
    }

    public function toArrayMapper(): array
    {
        return [
            "obtenor" => $this->obtenor,
            "familia" => $this->familia,
            "grupo" => $this->grupo
        ];
    }

    public static function fromArrayMapper(array $data): self
    {
        return new self(
            $data['obtenor'] ?? '',
            $data['familia'] ?? '',
            $data['grupo'] ?? ''
        );
    }
}
