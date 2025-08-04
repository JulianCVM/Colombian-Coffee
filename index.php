<?php

require_once "vendor/autoload.php";

use App\Infraestructure\Database\Connection;
use Slim\Factory\AppFactory;
use Dotenv\Dotenv;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\Interfaces\ErrorHandlerInterface;

try {
    // Cargar variables de entorno
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    // Crear contenedor de dependencias y aplicación
    $container = require_once __DIR__ . '/bootstrap/container.php';
    AppFactory::setContainer($container);
    $app = AppFactory::create();

    // Inicializar conexión a la base de datos
    Connection::init();

    // Registrar response factory en el contenedor
    $container->set(ResponseFactoryInterface::class, $app->getResponseFactory());

    // Cargar middlewares y rutas
    (require_once __DIR__ . '/public/index.php')($app);
    (require_once __DIR__ . '/src/Modules/Variedad/routes/variedad.php')($app);
    (require_once __DIR__ . '/src/Modules/Imagenes/routes/imagenes.php')($app);
    (require_once __DIR__ . '/src/Modules/HistoriaLinaje/routes/HistoriaLinaje.php')($app);
    (require_once __DIR__ . '/src/Modules/Condicion/routes/condicion.php')($app);
    (require_once __DIR__ . '/src/Modules/PotencialDeRendimiento/routes/PotencialDeRendimiento.php')($app);

    // Configurar manejo de errores
    $errorHandler = $app->addErrorMiddleware(true, true, true);
    $errorHandler->setDefaultErrorHandler($container->get(ErrorHandlerInterface::class));

    // Ejecutar la aplicación
    $app->run();
} catch (\Exception $e) {
    // Mostrar error en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['error' => $e->getMessage()]);
}
