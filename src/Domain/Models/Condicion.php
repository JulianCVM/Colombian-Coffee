<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Condicion extends Model
{
    protected $table = 'condiciones';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['genetica', 'clima', 'suelo', 'practicas_cultivo', 'temperatura'];
}
