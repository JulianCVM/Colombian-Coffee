<?php

namespace App\Modules\TamanhoGrano\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class TamanhoGrano extends Model
{
    protected $table = 'tamanho_grano';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['tamanho'];
}
