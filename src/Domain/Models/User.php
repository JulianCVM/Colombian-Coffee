<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id'; // Llave primaria
    protected $fillable = ['nombre', 'email', 'password', 'rol'];
    protected $hidden = ['password'];
    public $timestamps = false; // Porque usas "creado_en", no created_at/updated_at
}
