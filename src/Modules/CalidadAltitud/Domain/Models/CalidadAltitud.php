<?php

namespace App\Modules\CalidadAltitud\Domain\Models;

use App\Modules\Ubicacion\Domain\Models\Ubicacion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CalidadAltitud extends Model
{
    protected $table = 'calidad_altitud';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['ubicacion', 'calidad'];

    public function ubicacion(): BelongsTo
    {
        return $this->belongsTo(Ubicacion::class, 'ubicacion');
    }
}
