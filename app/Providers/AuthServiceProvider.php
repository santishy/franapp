<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Client' => 'App\Policies\ClientPolicy',
        'App\Models\Category' => 'App\Policies\CategoryPolicy',
        'App\Models\Product' => 'App\Policies\ProductPolicy',
        'App\Models\Purchase' => 'App\Policies\PurchasePolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
    public function before(){
        return false;
    }
}
