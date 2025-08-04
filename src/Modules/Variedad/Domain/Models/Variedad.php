<?php

namespace App\Modules\Variedad\Domain\Models;

use App\Modules\CalidadAltitud\Domain\Models\CalidadAltitud;
use App\Modules\DatosAgronomicos\Domain\Models\DatosAgronomicos;
use App\Modules\HistoriaLinaje\Domain\Models\HistoriaLinaje;
use App\Modules\Porte\Domain\Models\Porte;
use App\Modules\PotencialDeRendimiento\Domain\Models\PotencialDeRendimiento;
use App\Modules\Resistencia\Domain\Models\Resistencia;
use App\Modules\TamanhoGrano\Domain\Models\TamanhoGrano;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// La clase Variedad viene siendo el modelo del cual se define que logica se va a manejar para la tabla variedad
class Variedad extends Model
{
    protected $table = 'variedad'; // Nombre de la tabla "variedad" que es donde se almacena toda la info de el modelo
    protected $primaryKey = 'id'; // Llave primaria de la tabla
    public $timestamps = false; // Deshabilito el uso de created_at y updated_at
    // Campos de la tabla que estan habilitados para ser llenados
    protected $fillable = [
        'nombre_comun',
        'nombre_cientifico',
        'descripcion_general',
        'porte',
        'tamanho_del_grano',
        'altitud_optima_siembra',
        'potencial_de_rendimiento',
        'calidad_grano_altitud',
        'resistencia',
        'datos_agronomicos',
        'historia',
    ];


    // --- Relaciones directas (FK) ---

    public function porte(): BelongsTo
    {
        return $this->belongsTo(Porte::class, 'porte');
    }

    public function tamanhoGrano(): BelongsTo
    {
        return $this->belongsTo(TamanhoGrano::class, 'tamanho_del_grano');
    }

    public function potencial(): BelongsTo
    {
        return $this->belongsTo(PotencialDeRendimiento::class, 'potencial_de_rendimiento');
    }

    public function calidadAltitud(): BelongsTo
    {
        return $this->belongsTo(CalidadAltitud::class, 'calidad_grano_altitud');
    }

    public function resistencia(): BelongsTo
    {
        return $this->belongsTo(Resistencia::class, 'resistencia');
    }

    public function datosAgronomicos(): BelongsTo
    {
        return $this->belongsTo(DatosAgronomicos::class, 'datos_agronomicos');
    }

    public function historia(): BelongsTo
    {
        return $this->belongsTo(HistoriaLinaje::class, 'historia');
    }

    // --- Relaciones a través de otras tablas (nested) ---

    public function condiciones()
    {
        return $this->potencial?->condicion();
    }

    public function ubicacion()
    {
        return $this->calidadAltitud?->ubicacion();
    }

    public function calidadGrano()
    {
        return $this->resistencia?->calidadGrano();
    }

    public function enfermedad()
    {
        return $this->resistencia?->enfermedad();
    }

    public function densidad()
    {
        return $this->datosAgronomicos?->densidad();
    }
}
