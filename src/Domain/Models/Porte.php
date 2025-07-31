<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;


class Porte extends Model
{
    protected $table = 'porte';
    protected $fillable = ['porte', 'manejo_cultivo'];
}
