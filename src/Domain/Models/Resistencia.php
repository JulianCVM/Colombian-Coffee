<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Resistencia extends Model
{
    protected $table = 'resistencias';
    protected $fillable = ['tipo', 'calidad_grano', 'enfermedad'];

    public function calidadGrano(): BelongsTo
    {
        return $this->belongsTo(CalidadGrano::class, 'calidad_grano');
    }

    public function enfermedad(): BelongsTo
    {
        return $this->belongsTo(Enfermedad::class, 'enfermedad');
    }
}
