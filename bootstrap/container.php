<?php

use DI\Container;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\Interfaces\ErrorHandlerInterface;
use App\Handler\CustomErrorHandler;
use App\Modules\Condicion\Domain\Repositories\CondicionRepositoryInterface;
use App\Modules\Condicion\Infraestructure\Repositories\EloquentCondicionRepository;
use App\Modules\DatosAgronomicos\Domain\Repositories\DatoAgroRepositoryInterface;
use App\Modules\DatosAgronomicos\Infraestructure\Repositories\EloquentDatoAgroRepository;
use App\Modules\Densidad\Domain\Repositories\DensidadRepositoryInterface;
use App\Modules\Densidad\Infraestructure\Repositories\EloquentDensidadRepository;
use App\Modules\Enfermedad\Domain\Repositories\EnfermedadRepositoryInterface;
use App\Modules\Enfermedad\Infraestructure\Repositories\EloquentEnfermedadRepository;
use App\Modules\HistoriaLinaje\Domain\Repositories\HistoriaLinajeRepositoryInterface;
use App\Modules\HistoriaLinaje\Infraestructure\Repositories\EloquentHistoriaLinajeRepository;
use App\Modules\Imagenes\Domain\Repositories\ImagenRepositoryInterface;
use App\Modules\Imagenes\Infraestructure\Repositories\EloquentImagenRepository;
use App\Modules\Porte\Domain\Repositories\PorteRepositoryInterface;
use App\Modules\Porte\Repositories\EloquentPorteRepository;
use App\Modules\PotencialDeRendimiento\Domain\Repositories\PotencialDeRendimientoRepositoryInterface;
use App\Modules\PotencialDeRendimiento\Repositories\EloquentPotencialDeRendimientoRepository;
use App\Modules\Resistencia\Domain\Repositories\ResistenciaRepositoryInterface;
use App\Modules\Resistencia\Infraestructure\Repositories\EloquentResistenciaRepository;
use App\Modules\TamanhoGrano\Domain\Repositories\TamanhoGranoRepositoryInterface;
use App\Modules\TamanhoGrano\Repositories\EloquentTamanhoGranoRepository;
use App\Modules\Ubicacion\Domain\Repositories\UbicacionRepositoryInterface;
use App\Modules\Ubicacion\Repositories\EloquentUbicacionRepository;
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

$container->set(PotencialDeRendimientoRepositoryInterface::class, function () {
    return new EloquentPotencialDeRendimientoRepository;
});

$container->set(TamanhoGranoRepositoryInterface::class, function () {
    return new EloquentTamanhoGranoRepository;
});

$container->set(UbicacionRepositoryInterface::class, function () {
    return new EloquentUbicacionRepository;
});

$container->set(PorteRepositoryInterface::class, function () {
    return new EloquentPorteRepository;
});

$container->set(EnfermedadRepositoryInterface::class, function () {
    return new EloquentEnfermedadRepository;
});

$container->set(DensidadRepositoryInterface::class, function () {
    return new EloquentDensidadRepository;
});

$container->set(ResistenciaRepositoryInterface::class, function () {
    return new EloquentResistenciaRepository;
});

$container->set(DatoAgroRepositoryInterface::class, function () {
    return new EloquentDatoAgroRepository;
});


// Handler


$container->set(ErrorHandlerInterface::class, function () use ($container) {
    return new CustomErrorHandler(
        $container->get(ResponseFactoryInterface::class)
    );
});



return $container;
