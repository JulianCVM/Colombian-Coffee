<?php

use App\Domain\Repositories\VariedadRepositoryInterface;
use App\Infraestructure\Repositories\EloquentVariedadRepository;
use DI\Container;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\Interfaces\ErrorHandlerInterface;


$container = new Container();

$container->set(VariedadRepositoryInterface::class, function () {
    return new EloquentVariedadRepository;
});




return $container;
