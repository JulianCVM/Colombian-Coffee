<?php

require_once "vendor/autoload.php";

use App\Infraestructure\Database\Connection;
use Slim\Factory\AppFactory;
use Dotenv\Dotenv;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\Interfaces\ErrorHandlerInterface;


// Se usa la variable magica para sacar la carga de la ruta del .env
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();   // Se hace la carga del .env -> $_ENV[...]


// Se hace la carga del container 
$container = require_once __DIR__ . '/bootstrap/container.php';

$app = AppFactory::setContainer($container);
$app = AppFactory::create();

$app->addBodyParsingMiddleware();

Connection::init();

$container->set(ResponseFactoryInterface::class, $app->getResponseFactory());



(require_once __DIR__ . '/public/index.php')($app);
(require_once __DIR__ . '/routes/variedad.php')($app);
(require_once __DIR__ . '/routes/auth.php')($app);


$app->run();
