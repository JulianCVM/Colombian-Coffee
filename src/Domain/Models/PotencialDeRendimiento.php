<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PotencialDeRendimiento extends Model
{
    protected $table = 'potencial_de_rendimiento';
    protected $fillable = ['potencial', 'condicion'];

    public function condicion(): BelongsTo
    {
        return $this->belongsTo(Condicion::class, 'condicion');
    }
}
