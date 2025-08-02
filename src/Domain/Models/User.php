<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'email', 'password', 'rol'];
    protected $hidden = ['password'];
    public $timestamps = false; // Porque usas "creado_en", no created_at/updated_at

    // Método para acceder al ID
    public function getId(): int
    {
        return $this->id;
    }

    // Método para acceder al email
    public function getEmail(): string
    {
        return $this->email;
    }

    // Método para acceder al rol
    public function getRole(): string
    {
        return $this->rol;
    }

    // Método para acceder al password (para validación)
    public function getPassword(): string
    {
        return $this->password;
    }
}