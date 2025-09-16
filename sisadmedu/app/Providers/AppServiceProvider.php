<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{

    // Registrar cualquier servicio de la aplicación.
    public function register(): void
    {
        //
    }

    // Bootstrap cualquier servicio de la aplicación.
    // Aquí se configura el uso de Bootstrap para la paginación.
    // Esto permite que los enlaces de paginación se muestren con el estilo de Bootstrap.
    // Se utiliza el método 'useBootstrap' de la clase Paginator para aplicar el estilo.
    // Esto es útil para mantener una apariencia consistente en la interfaz de usuario.
    public function boot(): void
    {
        Paginator::useBootstrap();
        \Carbon\Carbon::setLocale(config('app.locale'));
        
    }
}
