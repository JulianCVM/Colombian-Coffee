<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class CalidadGrano extends Model
{
    protected $table = 'calidad_grano';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['calidad', 'aroma', 'sabor', 'densidad', 'humedad', 'tueste', 'origen'];
}
