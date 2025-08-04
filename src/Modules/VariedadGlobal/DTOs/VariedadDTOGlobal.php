<?php

namespace App\Modules\VariedadGlobal\DTOs;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class VariedadDTOGlobal
{
    public function __construct(
        public readonly string $nombre_comun,
        public readonly string $nombre_cientifico,
        public readonly string $descripcion_general,

        public readonly array $porte,

        public readonly array $tamanho_del_grano,

        public readonly float $altitud_optima_siembra,

        public readonly array $potencial_de_rendimiento,

        public readonly array $calidad_grano_altitud,

        public readonly array $calidad_grano,

        public readonly array $resistencia,

        public readonly array $datos_agronomicos,

        public readonly array $historia,

    ) {
        $this->validateData();
    }


    private function validateData(): void
    {
        try {
            // Obligatorios
            v::stringType()->length(3, 255)->notEmpty()->check($this->nombre_comun);
            v::stringType()->length(3, 255)->notEmpty()->check($this->nombre_cientifico);
            v::stringType()->length(3, 1000)->notEmpty()->check($this->descripcion_general);
        } catch (NestedValidationException $e) {
            throw new \InvalidArgumentException('Error en validación: ' . $e->getFullMessage());
        }
    }



    public function toArrayMapper(): array
    {
        return get_object_vars($this);
    }
}
