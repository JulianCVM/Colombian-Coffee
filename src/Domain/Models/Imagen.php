<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

// La clase Imagen viene siendo el modelo del cual se define que logica se va a manejar para la tabla imagenes
class Imagen extends Model
{
    protected $table = 'imagenes'; // Nombre de la tabla "imagenes" que es donde se almacena toda la info de el modelo
    protected $primaryKey = 'id'; // Llave primaria de la tabla
    public $timestamps = false; // Deshabilito el uso de created_at y updated_at
    // Campos de la tabla que estan habilitados para ser llenados
    protected $fillable = [
        'nombre',
        'contenido'
    ];
}
