<?php

use App\Controllers\UserController;
use App\Domain\Repositories\UserRepositoryInterface;
use App\Infraestructure\Repositories\UserRepository;
use DI\Container;
use DI\ContainerBuilder;

$containerBuilder = new ContainerBuilder();

$containerBuilder->addDefinitions([
    // Repositories
    UserRepositoryInterface::class => function() {
        return new UserRepository();
    },
    
    // Controllers
    UserController::class => function(Container $container) {
        return new UserController(
            $container->get(UserRepositoryInterface::class)
        );
    }
]);

return $containerBuilder->build();