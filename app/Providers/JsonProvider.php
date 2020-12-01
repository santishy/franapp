<?php 

namespace App\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use JsonApiBuilder;

class JsonProvider extends ServiceProvider
{
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      Builder::mixin(new JsonApiBuilder());
    }
}