<?php

use App\Domain\Repositories\VariedadRepositoryInterface;
use App\Infraestructure\Repositories\EloquentVariedadRepository;
use DI\Container;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\Interfaces\ErrorHandlerInterface;
use App\Handler\CustomErrorHandler;


$container = new Container();

$container->set(VariedadRepositoryInterface::class, function () {
    return new EloquentVariedadRepository;
});




// Handler


$container->set(ErrorHandlerInterface::class, function () use ($container) {
    return new CustomErrorHandler(
        $container->get(ResponseFactoryInterface::class)
    );
});



return $container;
