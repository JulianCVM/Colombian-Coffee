<?php

namespace App\Infraestructure\Database;

use Exception;
use Illuminate\Database\Capsule\Manager as Capsule;

class Connection
{
    private static ?Capsule $capsule = null;

    public static function init(): bool
    {
        if (self::$capsule !== null) {
            return true; // Ya está inicializado
        }

        try {
            self::$capsule = new Capsule;
            
            self::$capsule->addConnection([
                'driver' => 'mysql',
                'host' => $_ENV['DB_HOST'],
                'database' => $_ENV['DB_NAME'],
                'username' => $_ENV['DB_USER'],
                'password' => $_ENV['DB_PASS'],
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'prefix' => '',
            ]);

            // Hacer que Eloquent esté disponible globalmente
            self::$capsule->setAsGlobal();
            
            // Boot Eloquent
            self::$capsule->bootEloquent();

            // Probar la conexión
            self::$capsule->getConnection()->getPdo();
            
            return true;
            
        } catch (Exception $ex) {
            throw new Exception("No se pudo establecer conexión con la base de datos: " . $ex->getMessage());
        }
    }

    public static function getCapsule(): ?Capsule
    {
        return self::$capsule;
    }
}