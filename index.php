<?php

// Debug temporal
file_put_contents('debug.log', "=== REQUEST ===\n", FILE_APPEND);
file_put_contents('debug.log', "URI: " . $_SERVER['REQUEST_URI'] . "\n", FILE_APPEND);
file_put_contents('debug.log', "METHOD: " . $_SERVER['REQUEST_METHOD'] . "\n", FILE_APPEND);
file_put_contents('debug.log', "TIME: " . date('Y-m-d H:i:s') . "\n\n", FILE_APPEND);

require_once "vendor/autoload.php";

use App\Infraestructure\Database\Connection;
use Slim\Factory\AppFactory;
use Dotenv\Dotenv;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\Interfaces\ErrorHandlerInterface;

try {
    file_put_contents('debug.log', "Iniciando aplicación Slim\n", FILE_APPEND);

    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $container = require_once __DIR__ . '/bootstrap/container.php';
    $app = AppFactory::setContainer($container);
    $app = AppFactory::create();

    Connection::init();

    $container->set(ResponseFactoryInterface::class, $app->getResponseFactory());

    // Cargar middleware
    (require_once __DIR__ . '/public/index.php')($app);

    // Rutas
    (require_once __DIR__ . '/routes/variedad.php')($app);
    (require_once __DIR__ . '/routes/imagenes.php')($app);

    // Error handling
    $errorHandler = $app->addErrorMiddleware(true, true, true);
    $errorHandler->setDefaultErrorHandler($container->get(ErrorHandlerInterface::class));

    file_put_contents('debug.log', "Ejecutando app->run()\n", FILE_APPEND);

    $app->run();
} catch (\Exception $e) {
    file_put_contents('debug.log', "ERROR: " . $e->getMessage() . "\n", FILE_APPEND);
    file_put_contents('debug.log', "TRACE: " . $e->getTraceAsString() . "\n", FILE_APPEND);

    // Mostrar error en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['error' => $e->getMessage()]);
}
