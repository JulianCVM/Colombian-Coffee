<?php

namespace App\Infraestructure\Repositories;

use App\Domain\Models\CalidadAltitud;
use App\Domain\Models\CalidadGrano;
use App\Domain\Models\DatosAgronomicos;
use App\Domain\Models\HistoriaLinaje;
use App\Domain\Models\Porte;
use App\Domain\Models\PotencialDeRendimiento;
use App\Domain\Models\Resistencia;
use App\Domain\Models\TamanhoGrano;
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

            // Funcion helper para verificar y cargar relaciones manualmente si es necesario
            $getRelationData = function ($relation, $modelClass, $id) {
                if (is_object($relation)) {
                    return $relation->toArray();
                } elseif (is_numeric($relation) && $relation > 0) {
                    // Si es un ID, cargar manualmente
                    $model = $modelClass::find($relation);
                    return $model ? $model->toArray() : null;
                }
                return null;
            };

            // Funcion para cargar relaciones anidadas
            $getNestedRelation = function ($parentRelation, $nestedRelationName, $modelClass) {
                if (is_object($parentRelation) && isset($parentRelation->{$nestedRelationName})) {
                    $nested = $parentRelation->{$nestedRelationName};
                    if (is_object($nested)) {
                        return $nested->toArray();
                    } elseif (is_numeric($nested)) {
                        $model = $modelClass::find($nested);
                        return $model ? $model->toArray() : null;
                    }
                }
                return null;
            };

            // Obtener relaciones directas
            $porte_data = $getRelationData(
                $variedad->porte,
                Porte::class,
                $variedad->getAttributes()['porte'] ?? null
            );

            $tamanho_grano_data = $getRelationData(
                $variedad->tamanhoGrano,
                TamanhoGrano::class,
                $variedad->getAttributes()['tamanho_del_grano'] ?? null
            );

            $potencial_data = $getRelationData(
                $variedad->potencial,
                PotencialDeRendimiento::class,
                $variedad->getAttributes()['potencial_de_rendimiento'] ?? null
            );

            $calidad_altitud_data = $getRelationData(
                $variedad->calidadAltitud,
                CalidadAltitud::class,
                $variedad->getAttributes()['calidad_grano_altitud'] ?? null
            );

            $datos_agronomicos_data = $getRelationData(
                $variedad->datosAgronomicos,
                DatosAgronomicos::class,
                $variedad->getAttributes()['datos_agronomicos'] ?? null
            );

            $historia_data = $getRelationData(
                $variedad->historia,
                HistoriaLinaje::class,
                $variedad->getAttributes()['historia'] ?? null
            );

            // Manejar resistencia y sus relaciones anidadas
            $resistencia_obj = $variedad->resistencia;
            $resistencia_data = null;
            $calidad_grano_data = null;

            if (is_object($resistencia_obj)) {
                $resistencia_data = $resistencia_obj->toArray();
                $calidad_grano_data = $getNestedRelation(
                    $resistencia_obj,
                    'calidadGrano',
                    CalidadGrano::class
                );
            } elseif (is_numeric($resistencia_obj)) {
                // Cargar resistencia manualmente con sus relaciones
                $resistencia_model = Resistencia::with(['calidadGrano', 'enfermedad'])->find($resistencia_obj);
                if ($resistencia_model) {
                    $resistencia_data = $resistencia_model->toArray();
                    $calidad_grano_data = $resistencia_model->calidadGrano ? $resistencia_model->calidadGrano->toArray() : null;
                }
            }

            return new VariedadDTOGlobal(
                $variedad->nombre_comun,
                $variedad->nombre_cientifico,
                $variedad->descripcion_general,
                $porte_data,
                $tamanho_grano_data,
                $variedad->altitud_optima_siembra,
                $potencial_data,
                $calidad_altitud_data,
                $calidad_grano_data,
                $resistencia_data,
                $datos_agronomicos_data,
                $historia_data
            );
        })->toArray();
    }
}
