<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class HistoriaLinaje extends Model
{
    protected $table = 'historia_linaje';
    protected $fillable = ['obtenor', 'familia', 'grupo'];
}
