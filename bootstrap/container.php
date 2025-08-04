<?php

use DI\Container;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\Interfaces\ErrorHandlerInterface;
use App\Handler\CustomErrorHandler;
use App\Infraestructure\Repositories\EloquentImagenRepository;
use App\Modules\Imagenes\Domain\Repositories\ImagenRepositoryInterface;
use App\Modules\Variedad\Domain\Repositories\VariedadRepositoryInterface;
use App\Modules\Variedad\Infraestructure\Repositories\EloquentVariedadRepository;
use App\Modules\VariedadGlobal\Domain\Repositories\VariedadGlobalRepositoryInterface;
use App\Modules\VariedadGlobal\Infraestructure\Repositories\EloquentVariedadGlobalRepository;

$container = new Container();

$container->set(VariedadRepositoryInterface::class, function () {
    return new EloquentVariedadRepository;
});

$container->set(VariedadGlobalRepositoryInterface::class, function () {
    return new EloquentVariedadGlobalRepository;
});

$container->set(ImagenRepositoryInterface::class, function () {
    return new EloquentImagenRepository;
});



// Handler


$container->set(ErrorHandlerInterface::class, function () use ($container) {
    return new CustomErrorHandler(
        $container->get(ResponseFactoryInterface::class)
    );
});



return $container;
