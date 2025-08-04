<?php

namespace App\Modules\Resistencia\Domain\Models;

use App\Modules\CalidadGrano\Domain\Models\CalidadGrano;
use App\Modules\Enfermedad\Domain\Models\Enfermedad;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Resistencia extends Model
{
    protected $table = 'resistencias';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['tipo', 'calidad_grano', 'enfermedad'];

    public function calidadGrano(): BelongsTo
    {
        return $this->belongsTo(CalidadGrano::class, 'calidad_grano', 'id');
    }

    public function enfermedad(): BelongsTo
    {
        return $this->belongsTo(Enfermedad::class, 'enfermedad', 'id');
    }
}
