<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DatosAgronomicos extends Model
{
    protected $table = 'datos_agronomicos';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['tiempo_cosecha', 'maduracion', 'nutricion', 'densidad_de_siembra'];

    public function densidad(): BelongsTo
    {
        return $this->belongsTo(Densidad::class, 'densidad_de_siembra');
    }
}
