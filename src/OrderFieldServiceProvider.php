<?php

namespace Gtmassey\NovaOrderField;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class OrderFieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script('order-field', __DIR__.'/../dist/js/field.js');
        });

        $this->app->booted(function () {
            $this->loadRoutes();
        });
    }

    /**
     * Register the field's routes.
     *
     * @return void
     */
    protected function loadRoutes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova', 'api'])
            ->prefix('nova-vendor/michielkempen/nova-order-field')
            ->group(__DIR__.'/../routes/api.php');
    }
}
