<?php

namespace App\Infraestructure\Repositories;

use App\Domain\Models\Variedad;
use App\DTOs\VariedadDTOGlobal;
use App\Domain\Repositories\VariedadGlobalRepositoryInterface;

class EloquentVariedadGlobalRepository implements VariedadGlobalRepositoryInterface
{
    public function obtenerTodo(): array
    {
        // Cargar todas las relaciones necesarias
        $variedades = Variedad::with([
            'porte',
            'tamanhoGrano',
            'potencial.condicion',
            'calidadAltitud.ubicacion',
            'resistencia.calidadGrano',
            'resistencia.enfermedad',
            'datosAgronomicos.densidad',
            'historia'
        ])->get();

        // Mapear cada variedad a un DTO
        return $variedades->map(function (Variedad $variedad) {
            return new VariedadDTOGlobal(
                $variedad->nombre_comun,
                $variedad->nombre_cientifico,
                $variedad->descripcion_general,

                // porte
                $variedad->porte?->porte ?? null,
                $variedad->porte?->manejo_cultivo ?? null,

                // tamanho grano
                $variedad->tamanhoGrano?->valor ?? null,

                $variedad->altitud_optima_siembra,

                // potencial rendimiento
                $variedad->potencial?->valor ?? null,

                // condiciones
                $variedad->potencial?->condicion?->genetica ?? null,
                $variedad->potencial?->condicion?->clima ?? null,
                $variedad->potencial?->condicion?->suelo ?? null,
                $variedad->potencial?->condicion?->practicas_cultivo ?? null,
                $variedad->potencial?->condicion?->temperatura ?? null,

                // calidad altitud
                $variedad->calidadAltitud?->id ?? 0,

                // ubicacion
                $variedad->calidadAltitud?->ubicacion?->departamento ?? null,
                $variedad->calidadAltitud?->ubicacion?->clima ?? null,
                $variedad->calidadAltitud?->ubicacion?->suelo ?? null,
                $variedad->calidadAltitud?->ubicacion?->altitud ?? null,
                $variedad->calidadAltitud?->ubicacion?->temperatura ?? null,
                $variedad->calidadAltitud?->ubicacion?->practica_cultivo ?? null,

                // resistencia
                $variedad->resistencia?->tipo ?? null,

                // calidad grano
                $variedad->resistencia?->calidadGrano?->calidad ?? null,
                $variedad->resistencia?->calidadGrano?->aroma ?? null,
                $variedad->resistencia?->calidadGrano?->sabor ?? null,
                $variedad->resistencia?->calidadGrano?->humedad ?? null,
                $variedad->resistencia?->calidadGrano?->tueste ?? null,

                // enfermedad
                $variedad->resistencia?->enfermedad?->nombre ?? null,
                $variedad->resistencia?->enfermedad?->efectos ?? null,
                $variedad->resistencia?->enfermedad?->gravedad ?? null,
                $variedad->resistencia?->enfermedad?->tratamiento ?? null,

                // datos agronómicos
                $variedad->datosAgronomicos?->tiempo_cosecha ?? null,
                $variedad->datosAgronomicos?->maduracion ?? null,
                $variedad->datosAgronomicos?->nutricion ?? null,

                // densidad
                $variedad->datosAgronomicos?->densidad?->valor ?? null,

                // historia
                $variedad->historia?->obtenor_id ?? null,
                $variedad->historia?->familia_id ?? null,
                $variedad->historia?->grupo_id ?? null
            );
        })->toArray();
    }
}
