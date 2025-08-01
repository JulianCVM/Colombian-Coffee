<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;


class Porte extends Model
{
    protected $table = 'porte';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['porte', 'manejo_cultivo'];
}
