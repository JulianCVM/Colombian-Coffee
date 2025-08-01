<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Enfermedad extends Model
{
    protected $table = 'enfermedades';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['nombre', 'efectos', 'gravedad', 'tratamiento'];
}
