<?php

namespace App\Modules\Ubicacion\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    protected $table = 'ubicacion';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['departamento', 'clima', 'suelo', 'altitud', 'temperatura', 'practica_cultivo'];
}
