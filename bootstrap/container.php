<?php

use DI\Container;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\Interfaces\ErrorHandlerInterface;
use App\Handler\CustomErrorHandler;
use App\Infraestructure\Repositories\EloquentImagenRepository;
use App\Modules\Condicion\Domain\Repositories\CondicionRepositoryInterface;
use App\Modules\Condicion\Infraestructure\Repositories\EloquentCondicionRepository;
use App\Modules\HistoriaLinaje\Domain\Repositories\HistoriaLinajeRepositoryInterface;
use App\Modules\HistoriaLinaje\Infraestructure\Repositories\EloquentHistoriaLinajeRepository;
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

$container->set(HistoriaLinajeRepositoryInterface::class, function () {
    return new EloquentHistoriaLinajeRepository;
});

$container->set(CondicionRepositoryInterface::class, function () {
    return new EloquentCondicionRepository;
});



// Handler


$container->set(ErrorHandlerInterface::class, function () use ($container) {
    return new CustomErrorHandler(
        $container->get(ResponseFactoryInterface::class)
    );
});



return $container;
