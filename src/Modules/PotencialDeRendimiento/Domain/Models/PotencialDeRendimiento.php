<?php

namespace App\Modules\PotencialDeRendimiento\Domain\Models;

use App\Modules\Condicion\Domain\Models\Condicion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PotencialDeRendimiento extends Model
{
    protected $table = 'potencial_de_rendimiento';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['potencial', 'condicion'];

    public function condicion(): BelongsTo
    {
        return $this->belongsTo(Condicion::class, 'condicion');
    }
}
