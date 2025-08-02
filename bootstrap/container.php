<?php

use DI\Container;
use DI\ContainerBuilder;
use App\Domain\Repositories\UserRepositoryInterface;
use App\Infraestructure\Repositories\UserRepository;
use App\Controllers\UserController;

$containerBuilder = new ContainerBuilder();

$containerBuilder->addDefinitions([
    // Repository bindings
    UserRepositoryInterface::class => \DI\create(UserRepository::class),
    
    // Controller bindings
    UserController::class => \DI\create(UserController::class)
        ->constructor(\DI\get(UserRepositoryInterface::class)),
]);

return $containerBuilder->build();