<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    protected $table = 'ubicacion';
    protected $fillable = ['departamento', 'clima', 'suelo', 'altitud', 'temperatura', 'practica_cultivo'];
}
