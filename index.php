<?php

require_once "vendor/autoload.php";

use App\Infraestructure\Database\Connection;
use Slim\Factory\AppFactory;
use Dotenv\Dotenv;

// Cargar variables de entorno
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Configurar el contenedor DI
$container = require_once __DIR__ . '/config/container.php';
AppFactory::setContainer($container);

// Crear la app
$app = AppFactory::create();

// Inicializar conexión a la base de datos
try {
    $connectionResult = Connection::init();
    if (!$connectionResult) {
        throw new Exception("Falló la inicialización de la base de datos");
    }
    echo "✅ Conexión a la base de datos establecida\n";
} catch (Exception $e) {
    echo "❌ Error de conexión: " . $e->getMessage() . "\n";
    die();
}

// Configurar middlewares personalizados (tu archivo actual)
(require_once __DIR__ . '/public/index.php')($app);

// Error middleware
$app->addErrorMiddleware(true, true, true);

// Manejar rutas OPTIONS para CORS
$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

// Cargar rutas
(require_once __DIR__ . '/routes/auth.php')($app);

$app->run();