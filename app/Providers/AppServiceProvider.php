<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\IServicioAppService;
use App\Services\ServicioAppService;
use App\Repositories\ServicioRepo\IServicioRepo;
use App\Repositories\ServicioRepo\ServicioRepo;

use App\Services\Servicio\IOtroServicioAppService;
use App\Services\Servicio\OtroServicioAppService;
use App\Repositories\OtroServicio\IOtroServicioRepo;
use App\Repositories\OtroServicio\OtroServicioRepo;

use App\Services\Salon\ISalonAppService;
use App\Services\Salon\SalonAppService;
use App\Repositories\Salon\ISalonRepo;
use App\Repositories\Salon\SalonRepo;

use App\Services\Orden\Detalle\DetalleOtro\IDetalleOtroAppService;
use App\Services\Orden\Detalle\DetalleOtro\DetalleOtroAppService;
use App\Repositories\OrdenServicio\DetalleServicio\Otro\DetalleOtroRepo;
use App\Repositories\OrdenServicio\DetalleServicio\Otro\IDetalleOtroRepo;

use App\Services\Orden\Detalle\DetalleSalon\IDetalleSalonAppService;
use App\Services\Orden\Detalle\DetalleSalon\DetalleSalonAppService;
use App\Repositories\OrdenServicio\DetalleServicio\Salon\DetalleSalonRepo;
use App\Repositories\OrdenServicio\DetalleServicio\Salon\IDetalleSalonRepo;

use App\Services\Orden\Detalle\DetalleServicio\IDetalleServicioAppService;
use App\Services\Orden\Detalle\DetalleServicio\DetalleServicioAppService;
use App\Repositories\OrdenServicio\DetalleServicio\Servicio\DetalleServicioRepo;
use App\Repositories\OrdenServicio\DetalleServicio\Servicio\IDetalleServicioRepo;

use App\Services\Orden\OrdenAppService;
use App\Services\Orden\IOrdenAppService;
use App\Repositories\OrdenServicio\IOrdenServicioRepo;
use App\Repositories\OrdenServicio\OrdenServicioRepo;

use App\Services\Cliente\ClienteAppService;
use App\Services\Cliente\IClienteAppService;
use App\Repositories\ClienteRepo\ClienteRepo;
use App\Repositories\ClienteRepo\IClienteRepo;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IServicioAppService::class, ServicioAppService::class);
        $this->app->bind(IServicioRepo::class, ServicioRepo::class);

        $this->app->bind(IOtroServicioAppService::class, OtroServicioAppService::class);
        $this->app->bind(IOtroServicioRepo::class, OtroServicioRepo::class);

        $this->app->bind(ISalonAppService::class, SalonAppService::class);
        $this->app->bind(ISalonRepo::class, SalonRepo::class);

        $this->app->bind(IClienteAppService::class, ClienteAppService::class);
        $this->app->bind(IClienteRepo::class, ClienteRepo::class);

        $this->app->bind(IDetalleOtroAppService::class, DetalleOtroAppService::class);
        $this->app->bind(IDetalleOtroRepo::class, DetalleOtroRepo::class);

        $this->app->bind(IDetalleSalonAppService::class, DetalleSalonAppService::class);
        $this->app->bind(IDetalleSalonRepo::class, DetalleSalonRepo::class);

        $this->app->bind(IDetalleServicioAppService::class, DetalleServicioAppService::class);
        $this->app->bind(IDetalleServicioRepo::class, DetalleServicioRepo::class);

        $this->app->bind(IOrdenAppService::class, OrdenAppService::class);
        $this->app->bind(IOrdenServicioRepo::class, OrdenServicioRepo::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
