<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Densidad extends Model
{
    protected $table = 'densidad';
    protected $fillable = ['porte', 'tamanho_grano', 'valor_densidad'];
}
