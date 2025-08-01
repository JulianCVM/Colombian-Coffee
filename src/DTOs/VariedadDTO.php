<?php

namespace App\DTOs;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;


// Se crea el DTO que va a manejar toda la data de Variedad
class VariedadDTO
{

    // se define la data del constructor del DTO donde se define que data se va a estar manejando en este mismo respecto a variedad
    public function __construct(
        public readonly string $nombre_comun,
        public readonly string $nombre_cientifico,
        public readonly string $descripcion_general,
        public readonly int $porte,
        public readonly int $tamanho_del_grano,
        public readonly float $altitud_optima_siembra,
        public readonly int $potencial_de_rendimiento,
        public readonly int $calidad_grano_altitud,
        public readonly int $resistencia,
        public readonly int $datos_agronomicos,
        public readonly int $historia,
    ) {
        // implementacion de la funcion de validacion de la data
        $this->validateData(
            $nombre_comun,
            $nombre_cientifico,
            $descripcion_general,
            $porte,
            $tamanho_del_grano,
            $altitud_optima_siembra,
            $potencial_de_rendimiento,
            $calidad_grano_altitud,
            $resistencia,
            $datos_agronomicos,
            $historia
        );
    }

    // funcion para validar toda la informacion del DTO para hacer validacion de tipo de dato para cada atributo
    private function validateData(
        string $nombre_comun,
        string $nombre_cientifico,
        string $descripcion_general,
        int $porte,
        int $tamanho_del_grano,
        float $altitud_optima_siembra,
        int $potencial_de_rendimiento,
        int $calidad_grano_altitud,
        int $resistencia,
        int $datos_agronomicos,
        int $historia
    ): void {
        try {
            // Se hacen las validaciones para strings, enteros y decimales (flotantes/float) validando para cada campo condiciones especificas de uso
            v::stringType()->notEmpty()->length(3, 255)->check($nombre_comun);
            v::stringType()->notEmpty()->length(3, 255)->check($nombre_cientifico);
            v::stringType()->notEmpty()->length(3, 255)->check($descripcion_general);
            v::intVal()->min(1)->check($porte);
            v::intVal()->min(1)->check($tamanho_del_grano);
            v::floatVal()->between(500, 3000)->check($altitud_optima_siembra); // La altitud minima para sembrar cafe son 500 metros sobre el nivel del mar y la maxima redondea los 1500 a 2000 pero se deja un rango mas amplio en caso tal de que sean por condiciones extras no contempladas en primer lugar
            v::intVal()->min(1)->check($potencial_de_rendimiento);
            v::intVal()->min(1)->check($calidad_grano_altitud);
            v::intVal()->min(1)->check($resistencia);
            v::intVal()->min(1)->check($datos_agronomicos);
            v::intVal()->min(1)->check($historia);
        } catch (NestedValidationException $e) {
            throw new \InvalidArgumentException($e->getFullMessage());
        }
    }


    // Se genera la funcion mapper de parseo a array para poder manejar el DTO como array y hacer el parseo de la data mas sencillo y resumido
    public function toArrayMapper(): array
    {
        return [
            "nombre_comun" => $this->nombre_comun,
            "nombre_cientifico" => $this->nombre_cientifico,
            "descripcion_general" => $this->descripcion_general,
            "porte" => $this->porte,
            "tamanho_del_grano" => $this->tamanho_del_grano,
            "altitud_optima_siembra" => $this->altitud_optima_siembra,
            "potencial_de_rendimiento" => $this->potencial_de_rendimiento,
            "calidad_grano_altitud" => $this->calidad_grano_altitud,
            "resistencia" => $this->resistencia,
            "datos_agronomicos" => $this->datos_agronomicos,
            "historia" => $this->historia
        ];
    }

    // funcion mapper para parsear de array a DTO
    public static function fromArrayMapper(array $data): self
    {
        return new self(
            $data['nombre_comun'] ?? '',
            $data['nombre_cientifico'] ?? '',
            $data['descripcion_general'] ?? null,
            $data['porte'] ?? '',
            $data['tamanho_del_grano'] ?? '',
            (int) ($data['altitud_optima_siembra'] ?? 0),
            (float) ($data['potencial_de_rendimiento'] ?? 0),
            $data['calidad_grano_altitud'] ?? '',
            $data['resistencia'] ?? '',
            $data['datos_agronomicos'] ?? [],
            $data['historia'] ?? null
        );
    }
}
