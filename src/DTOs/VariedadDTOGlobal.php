<?php

namespace App\DTOs;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class VariedadDTOGlobal
{
    public function __construct(
        public readonly string $nombre_comun,
        public readonly string $nombre_cientifico,
        public readonly string $descripcion_general,

        // campos opcionales (permiten null)
        public readonly ?string $porte_porte,
        public readonly ?string $manejo_cultivo_porte,
        public readonly ?string $tamanho_del_grano,
        public readonly ?float $altitud_optima_siembra,
        public readonly ?string $potencial,
        public readonly ?string $genetica_condiciones,
        public readonly ?string $clima_condiciones,
        public readonly ?string $suelo_condiciones,
        public readonly ?string $practicas_cultivo_condiciones,
        public readonly ?string $temperatura_condiciones,
        public readonly ?string $calidad_altitud,
        public readonly ?string $departamento_ubicacion,
        public readonly ?string $clima_ubicacion,
        public readonly ?string $suelo_ubicacion,
        public readonly ?string $altitud_ubicacion,
        public readonly ?string $temperatura_ubicacion,
        public readonly ?string $practica_cultivo_ubicacion,
        public readonly ?string $tipo_resistencia,
        public readonly ?string $calidad_grano,
        public readonly ?string $aroma,
        public readonly ?string $sabor,
        public readonly ?string $humedad,
        public readonly ?string $tueste,
        public readonly ?string $nombre_enfermedad,
        public readonly ?string $efectos,
        public readonly ?string $gravedad,
        public readonly ?string $tratamiento,
        public readonly ?string $tiempo_cosecha,
        public readonly ?string $maduracion,
        public readonly ?string $nutricion,
        public readonly ?string $valor_densidad,
        public readonly ?string $obtenor,
        public readonly ?string $familia,
        public readonly ?string $grupo,
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

            // Opcionales
            if ($this->porte_porte !== null) {
                v::stringType()->notEmpty()->check($this->porte_porte);
            }

            if ($this->manejo_cultivo_porte !== null) {
                v::stringType()->notEmpty()->check($this->manejo_cultivo_porte);
            }

            if ($this->tamanho_del_grano !== null) {
                v::stringType()->notEmpty()->check($this->tamanho_del_grano);
            }

            if ($this->altitud_optima_siembra !== null) {
                v::floatVal()->between(500, 3000)->check($this->altitud_optima_siembra);
            }

            if ($this->potencial !== null) {
                v::stringType()->notEmpty()->check($this->potencial);
            }

            foreach (
                [
                    $this->genetica_condiciones,
                    $this->clima_condiciones,
                    $this->suelo_condiciones,
                    $this->practicas_cultivo_condiciones,
                    $this->temperatura_condiciones,
                ] as $condicion
            ) {
                if ($condicion !== null) {
                    v::stringType()->notEmpty()->check($condicion);
                }
            }

            if ($this->calidad_altitud !== null) {
                v::intVal()->min(1)->check($this->calidad_altitud);
            }

            foreach (
                [
                    $this->departamento_ubicacion,
                    $this->clima_ubicacion,
                    $this->suelo_ubicacion,
                    $this->altitud_ubicacion,
                    $this->temperatura_ubicacion,
                    $this->practica_cultivo_ubicacion,
                ] as $ubicacion
            ) {
                if ($ubicacion !== null) {
                    v::stringType()->notEmpty()->check($ubicacion);
                }
            }

            if ($this->tipo_resistencia !== null) {
                v::stringType()->notEmpty()->check($this->tipo_resistencia);
            }

            foreach (
                [
                    $this->calidad_grano,
                    $this->aroma,
                    $this->sabor,
                    $this->humedad,
                    $this->tueste,
                ] as $calidad
            ) {
                if ($calidad !== null) {
                    v::stringType()->notEmpty()->check($calidad);
                }
            }

            foreach (
                [
                    $this->nombre_enfermedad,
                    $this->efectos,
                    $this->gravedad,
                    $this->tratamiento,
                ] as $enfermedad
            ) {
                if ($enfermedad !== null) {
                    v::stringType()->notEmpty()->check($enfermedad);
                }
            }

            foreach (
                [
                    $this->tiempo_cosecha,
                    $this->maduracion,
                    $this->nutricion,
                ] as $dato
            ) {
                if ($dato !== null) {
                    v::stringType()->notEmpty()->check($dato);
                }
            }

            if ($this->valor_densidad !== null) {
                v::stringType()->notEmpty()->check($this->valor_densidad);
            }

            foreach (
                [
                    $this->obtenor,
                    $this->familia,
                    $this->grupo,
                ] as $historia_lin
            ) {
                if ($historia_lin !== null) {
                    v::stringType()->notEmpty()->check($dato);
                }
            }
        } catch (NestedValidationException $e) {
            throw new \InvalidArgumentException('Error en validación: ' . $e->getFullMessage());
        }
    }



    public function toArrayMapper(): array
    {
        return get_object_vars($this);
    }

    public static function fromArrayMapper(array $data): self
    {
        return new self(
            $data['nombre_comun'] ?? 'N/A',
            $data['nombre_cientifico'] ?? 'N/A',
            $data['descripcion_general'] ?? 'N/A',

            $data['porte_porte'] ?? 'N/A',
            $data['manejo_cultivo_porte'] ?? 'N/A',

            $data['tamanho_del_grano'] ?? 'N/A',
            (float) ($data['altitud_optima_siembra'] ?? 1000),

            $data['potencial'] ?? 'N/A',

            $data['genetica_condiciones'] ?? 'N/A',
            $data['clima_condiciones'] ?? 'N/A',
            $data['suelo_condiciones'] ?? 'N/A',
            $data['practicas_cultivo_condiciones'] ?? 'N/A',
            $data['temperatura_condiciones'] ?? 'N/A',

            (int) ($data['calidad_altitud'] ?? 1),

            $data['departamento_ubicacion'] ?? 'N/A',
            $data['clima_ubicacion'] ?? 'N/A',
            $data['suelo_ubicacion'] ?? 'N/A',
            $data['altitud_ubicacion'] ?? 'N/A',
            $data['temperatura_ubicacion'] ?? 'N/A',
            $data['practica_cultivo_ubicacion'] ?? 'N/A',

            $data['tipo_resistencia'] ?? 'N/A',

            $data['calidad_grano'] ?? 'N/A',
            $data['aroma'] ?? 'N/A',
            $data['sabor'] ?? 'N/A',
            $data['humedad'] ?? 'N/A',
            $data['tueste'] ?? 'N/A',

            $data['nombre_enfermedad'] ?? 'N/A',
            $data['efectos'] ?? 'N/A',
            $data['gravedad'] ?? 'N/A',
            $data['tratamiento'] ?? 'N/A',

            $data['tiempo_cosecha'] ?? 'N/A',
            $data['maduracion'] ?? 'N/A',
            $data['nutricion'] ?? 'N/A',

            $data['valor_densidad'] ?? 'N/A',

            $data['obtenor'] ?? 'N/A',
            $data['familia'] ?? 'N/A',
            $data['grupo'] ?? 'N/A',


        );
    }
}
