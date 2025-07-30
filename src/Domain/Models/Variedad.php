<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Variedad extends Model
{
    protected $table = 'variedad'; // Nombre de la tabla "variedad" que es donde se almacena toda la info de el modelo
    protected $primaryKey = 'id'; // Llave primaria de la tabla
    public $timestamps = true; // Habilito el uso de created_at y updated_at
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
