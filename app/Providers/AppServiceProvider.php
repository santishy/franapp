<?php

namespace App\Providers;

use App\Authorization\CurrentUser;
use App\Gates\StockValidations;
use App\Services\InventoryContext;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('CurrentUser', CurrentUser::class);
        $this->app->bind('stockValidations', function () {
            return new StockValidations();
        });
        $this->app->bind('inventory.context', function () {
            return new InventoryContext;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {}
}
