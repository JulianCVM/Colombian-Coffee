<?php

namespace App\Infraestructure\Database;

use Exception;
use Illuminate\Database\Capsule\Manager as Capsule;


// Clase para establecer la conexion a la DB usando el .env para sacar las credenciales de conexion 
class Connection
{
    // funcion de arranque de conexion
    public static function init(): string|bool
    {
        $capsule = new Capsule;
        $capsule->addConnection(
            [
                'driver' => 'mysql',
                'host' => $_ENV['DB_HOST'],
                'database' => $_ENV['DB_NAME'],
                'username' => $_ENV['DB_USER'],
                'password' => $_ENV['DB_PASS'],
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix' => '',
            ]
        );
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
        try {
            Capsule::connection()->getPdo();
            return true;
        } catch (Exception $ex) {
            return "No se pudo establecer conexion con la base de datos: " . $ex->getMessage();
        }
    }
}
