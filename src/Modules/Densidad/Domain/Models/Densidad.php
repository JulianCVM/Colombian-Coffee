<?php

namespace App\Modules\Densidad\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Densidad extends Model
{
    protected $table = 'densidad';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['porte', 'tamanho_grano', 'valor_densidad'];
}
