<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Inventory;
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
        'App\Models\Purchase' => 'App\Policies\PurchasePolicy',
        'App\Models\Inventory' => 'App\Policies\WarehousePolicy',
        'Spatie\Permission\Models\Role' => 'App\Policies\RolePolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('register',function(User $user,User $model){
            return $user->hasPermissionTo('create user') || $user->hasRole('admin');
        });

        Gate::define('view-stock',function(User $user,Inventory $inventory){
            return $user->hasPermissionTo('view stock') || $user->hasRole('admin');
        });

        Gate::define('edit-stock',function(User $user,Inventory $inventory){
            return $user->hasPermissionTo('edit stock') || $user->hasRole('admin');
        });

        Gate::define('empty-stock',function(User $user,Inventory $inventory){
            return $user->hasPermissionTo('empty stock') || $user->hasRole('admin');
        });
    }
    public function before(){
        return false;
    }
}
