<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

// La clase Variedad viene siendo el modelo del cual se define que logica se va a manejar para la tabla variedad
class Variedad extends Model
{
    protected $table = 'variedad'; // Nombre de la tabla "variedad" que es donde se almacena toda la info de el modelo
    protected $primaryKey = 'id'; // Llave primaria de la tabla
    public $timestamps = false; // Deshabilito el uso de created_at y updated_at
    // Campos de la tabla que estan habilitados para ser llenados
    protected $fillable = [
        'nombre_comun',
        'nombre_cientifico',
        'imagen',
        'descripcion_general',
        'porte',
        'tamanho_del_grano',
        'altitud_optima_siembra',
        'potencial_de_rendimiento',
        'calidad_grano_altitud',
        'resistencia',
        'datos_agronomicos',
        'historia'
    ];
}
